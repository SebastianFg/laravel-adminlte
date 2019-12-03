<?php

namespace App\Http\Controllers\vehiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

/*modelos*/
use App\modelos\repuesto;
//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class RepuestoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getMensaje($mensaje,$destino,$desicion){
        if (!$desicion) {
            alert()->error('Error',$mensaje);
            return  redirect()->route($destino);
        }else{
            alert()->success( $mensaje);
            return  redirect()->route($destino);  
        }

    }
	protected function paginar($datos){
    	 $currentPage = LengthAwarePaginator::resolveCurrentPage();

         $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Armamos la coleccion con los datos
        $collection = collect($datos);
 
        // definimos cuantos items por magina se mostraran
        $por_pagina = 10;
 
        //armamos el paginador... sin el resolvecurrentpage arma la paginacion pero no mueve el selector
        $datos = new LengthAwarePaginator(
            $collection->forPage(Paginator::resolveCurrentPage() , $por_pagina),
            $collection->count(), $por_pagina,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
        return $datos;
	}

   public function index(Request $Request){
        if (Auth::User()->primer_logeo == null) {
            return redirect('admin/primerIngreso');
        }
        if ($Request->vehiculoBuscado == null) {
      		$repuestos = repuesto::join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_repuestos.id_vehiculo')
      							->join('users','users.id','=','detalle_asignacion_repuestos.id_responsable')
      							->orderBy('id_detalle_repuesto','desc')
      							->get();
        }else{
            $repuestos = repuesto::join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_repuestos.id_vehiculo')
                                ->join('users','users.id','=','detalle_asignacion_repuestos.id_responsable')
                                ->where('vehiculos.numero_de_identificacion','ilike',$Request->vehiculoBuscado)
                                ->orwhere('vehiculos.dominio','ilike',$Request->vehiculoBuscado)
                                ->orderBy('id_detalle_repuesto','desc')
                                ->get();
        }
        $repuestos = $this->paginar($repuestos);
        return view('vehiculos.repuestos.repuestos_alta_listado',compact('repuestos'));
    }

    public function AsignarRepuesto(Request $Request){
        
        $Validar = \Validator::make($Request->all(), [
            
            'id_vehiculo' => 'required',
            'fecha' => 'required',
            'repuestos_entregados' => 'required',
            'pdfrepuestos' => 'required'

        ]);

        if ($Validar->fails()){
            alert()->error('Error','Intente cargar neuvamente ...');
           return  back()->withInput()->withErrors($Validar->errors());
        }

       if($Request->hasFile('pdfrepuestos')){
            $file = $Request->file('pdfrepuestos');
            $nombre_archivo_nuevo = time().$file->getClientOriginalName();
            $file->move(public_path().'/pdf/',$nombre_archivo_nuevo);
        }


        $vehiculo_asignado_repuesto = new repuesto;
        $vehiculo_asignado_repuesto->id_vehiculo = $Request->id_vehiculo;
        $vehiculo_asignado_repuesto->fecha = $Request->fecha;
        $vehiculo_asignado_repuesto->repuestos_entregados = $Request->repuestos_entregados;
        $vehiculo_asignado_repuesto->pdf_nombre = $nombre_archivo_nuevo;
        $vehiculo_asignado_repuesto->id_responsable = Auth::User()->id;



        if($vehiculo_asignado_repuesto->save()){
             return $this->getMensaje('Asignado con exito','listaRepuestos',true); 
        }else{
            return $this->getMensaje('Intente nuevamente','listaRepuestos',false);
        } 
       
    }

    public function getAllVehiculosDisponiblesRepuestos(Request $Request){
        $vehiculos_disponibles = \DB::select("select * 
        									from vehiculos     
                                            where vehiculos.dominio ilike '%".$Request->termino."%' 
                                            or vehiculos.numero_de_identificacion ilike '%".$Request->termino."%' 
                                            and vehiculos.baja != 2" );

        return response()->json($vehiculos_disponibles);

    }

    public function exportarPdfRepuestos($id){
    	$vehiculos_repuestos_asignados = repuesto::join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_repuestos.id_vehiculo')
  							->join('users','users.id','=','detalle_asignacion_repuestos.id_responsable')
  							->where('detalle_asignacion_repuestos.id_detalle_repuesto','=',$id)
  							->orderBy('id_detalle_repuesto','desc')
  							->get();
    	//return $repuestos;

/*        $vehiculos_repuestos_asignados = \DB::select("
                select to_char(detalle_asignacion_Repuestos.fecha,'DD/MM/YYYY') as fecha,
                    vehiculos.id_vehiculo,
                    detalle_asignacion_Repuestos.id_detalle_repuesto,
                    detalle_asignacion_Repuestos.repuestos_entregados,
                    pdf_nombre,
                    vehiculos.numero_de_identificacion,
                    vehiculos.dominio,
                    vehiculos.numero_de_inventario,
                    vehiculos.marca,
                    vehiculos.clase_De_unidad,
                    users.name,
                    users.id
                    
                from detalle_asignacion_Repuestos
                inner join vehiculos on vehiculos.id_vehiculo = detalle_asignacion_Repuestos.vehiculo_id_repuestos 
                inner join users on users.id = detalle_asignacion_Repuestos.responsable
                where detalle_asignacion_Repuestos.id_detalle_repuesto =".$id);*/
        //return $vehiculos_repuestos_asignados;
        $pdf = PDF::loadView('vehiculos.repuestos.pdf_repuestos_asignados', compact('vehiculos_repuestos_asignados'));

        return $pdf->download($vehiculos_repuestos_asignados[0]->dominio.'.pdf');
    }
}
