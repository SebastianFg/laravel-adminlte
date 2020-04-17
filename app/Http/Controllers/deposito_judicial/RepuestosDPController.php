<?php

namespace App\Http\Controllers\deposito_judicial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;


//modelos
//use App\Modelos\vehiculos_deposito_judicial;
use App\Modelos\repuestosDP;


class RepuestosDPController extends Controller
{
	public function __construct(){
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
        $datos= new LengthAwarePaginator(
            $collection->forPage(Paginator::resolveCurrentPage() , $por_pagina),
            $collection->count(), $por_pagina,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
        return $datos;
	}

   public function indexDPRepuestos(Request $Request){
    /*return Auth::User()->id;*/
        if (Auth::User()->primer_logeo == null) {
            return redirect('/primerIngreso');
        }

        if ($Request->vehiculoBuscado == null && $Request->fechaDesde == null and $Request->fechaHasta == null) {
			$repuestos = repuestosDP::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','detalle_asignacion_repuestos_deposito_judicial.id_vehiculo_deposito_judicial')
      							->join('users','users.id','=','detalle_asignacion_repuestos_deposito_judicial.id_responsable')
                                ->select('detalle_asignacion_repuestos_deposito_judicial.*','vehiculos_deposito_judicial.dominio_deposito_judicial','vehiculos_deposito_judicial.numero_de_referencia_aleatorio_deposito_judicial','vehiculos_deposito_judicial.marca_deposito_judicial','vehiculos_deposito_judicial.clase_de_unidad_deposito_judicial','users.usuario')
      							->orderBy('id_detalle_repuesto_deposito_judicial','desc')
      							->get();
            //return $repuestos;
        }else if($Request->fechaDesde != null and $Request->fechaHasta == null){
            if (strpos(Auth::User()->roles,'Super Admin') || strpos(Auth::User()->roles,'Admin')) {
				$repuestos = repuestosDP::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','detalle_asignacion_repuestos_deposito_judicial.id_vehiculo_deposito_judicial')
	      							->join('users','users.id','=','detalle_asignacion_repuestos_deposito_judicial.id_responsable')
	                                ->select('detalle_asignacion_repuestos_deposito_judicial.*','vehiculos_deposito_judicial.dominio_deposito_judicial','vehiculos_deposito_judicial.numero_de_referencia_aleatorio_deposito_judicial','vehiculos_deposito_judicial.marca_deposito_judicial','vehiculos_deposito_judicial.clase_de_unidad_deposito_judicial','users.usuario')
	                                  ->whereBetween('detalle_asignacion_repuestos_deposito_judicial.created_at',[$Request->fechaDesde.' 00:00:00',date("Y-m-d 23:59:59")])
	      							->orderBy('id_detalle_repuesto_deposito_judicial','desc')
	      							->get();
  /*              $repuestos = repuesto::join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_repuestos.id_vehiculo')
                                    ->join('users','users.id','=','detalle_asignacion_repuestos.id_responsable')
                                    
                                    ->whereBetween('detalle_asignacion_repuestos.created_at',[$Request->fechaDesde.' 00:00:00',date("Y-m-d 23:59:59")])
                                    ->select('detalle_asignacion_repuestos.*','vehiculos.dominio','vehiculos.numero_de_identificacion','vehiculos.marca','vehiculos.clase_de_unidad','users.usuario')
                                    ->orderBy('id_detalle_repuesto','desc')
                                    ->get();*/
            }else{
				$repuestos = repuestosDP::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','detalle_asignacion_repuestos_deposito_judicial.id_vehiculo_deposito_judicial')
	      							->join('users','users.id','=','detalle_asignacion_repuestos_deposito_judicial.id_responsable')
	                                ->select('detalle_asignacion_repuestos_deposito_judicial.*','vehiculos_deposito_judicial.dominio_deposito_judicial','vehiculos_deposito_judicial.numero_de_referencia_aleatorio_deposito_judicial','vehiculos_deposito_judicial.marca_deposito_judicial','vehiculos_deposito_judicial.clase_de_unidad_deposito_judicial','users.usuario')
	                                ->where('detalle_asignacion_repuestos_deposito_judicial.id_responsable','=',Auth::User()->id)
	                                 ->whereBetween('detalle_asignacion_repuestos_deposito_judicial.created_at',[$Request->fechaDesde.' 00:00:00',date("Y-m-d 23:59:59")])
	      							->orderBy('id_detalle_repuesto_deposito_judicial','desc')
	      							->get();

/*                $repuestos = repuesto::join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_repuestos.id_vehiculo')
                                    ->join('users','users.id','=','detalle_asignacion_repuestos.id_responsable')
                                    ->where('detalle_asignacion_repuestos.id_responsable','=',Auth::User()->id)
                                    ->whereBetween('detalle_asignacion_repuestos.created_at',[$Request->fechaDesde.' 00:00:00',date("Y-m-d 23:59:59")])
                                    ->select('detalle_asignacion_repuestos.*','vehiculos.dominio','vehiculos.numero_de_identificacion','vehiculos.marca','vehiculos.clase_de_unidad','users.usuario')
                                    ->orderBy('id_detalle_repuesto','desc')
                                    ->get();*/
            }
        }else if($Request->fechaDesde != null and $Request->fechaHasta != null){
            if (strpos(Auth::User()->roles,'Super Admin') || strpos(Auth::User()->roles,'Admin')) {
				$repuestos = repuestosDP::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','detalle_asignacion_repuestos_deposito_judicial.id_vehiculo_deposito_judicial')
	      							->join('users','users.id','=','detalle_asignacion_repuestos_deposito_judicial.id_responsable')
	                                ->select('detalle_asignacion_repuestos_deposito_judicial.*','vehiculos_deposito_judicial.dominio_deposito_judicial','vehiculos_deposito_judicial.numero_de_referencia_aleatorio_deposito_judicial','vehiculos_deposito_judicial.marca_deposito_judicial','vehiculos_deposito_judicial.clase_de_unidad_deposito_judicial','users.usuario')
	                                ->whereBetween('detalle_asignacion_repuestos_deposito_judicial.created_at',[$Request->fechaDesde.' 00:00:00',$Request->fechaHasta.' 00:00:00'])
	      							->orderBy('id_detalle_repuesto_deposito_judicial','desc')
	      							->get();
/*
                $repuestos = repuesto::join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_repuestos.id_vehiculo')
                                    ->join('users','users.id','=','detalle_asignacion_repuestos.id_responsable')
                                   
                                     ->whereBetween('detalle_asignacion_repuestos.created_at',[$Request->fechaDesde.' 00:00:00',$Request->fechaHasta])
                                      
                                     ->select('detalle_asignacion_repuestos.*','vehiculos.dominio','vehiculos.numero_de_identificacion','vehiculos.marca','vehiculos.clase_de_unidad','users.usuario')
                                    ->orderBy('id_detalle_repuesto','desc')
                                    ->get();*/
            }else{
				$repuestos = repuestosDP::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','detalle_asignacion_repuestos_deposito_judicial.id_vehiculo_deposito_judicial')
	      							->join('users','users.id','=','detalle_asignacion_repuestos_deposito_judicial.id_responsable')
	                                ->select('detalle_asignacion_repuestos_deposito_judicial.*','vehiculos_deposito_judicial.dominio_deposito_judicial','vehiculos_deposito_judicial.numero_de_referencia_aleatorio_deposito_judicial','vehiculos_deposito_judicial.marca_deposito_judicial','vehiculos_deposito_judicial.clase_de_unidad_deposito_judicial','users.usuario')
	                                ->where('detalle_asignacion_repuestos_deposito_judicial.id_responsable','=',Auth::User()->id)
	                                ->whereBetween('detalle_asignacion_repuestos_deposito_judicial.created_at',[$Request->fechaDesde.' 00:00:00',$Request->fechaHasta.' 23:59:59'])
	      							->orderBy('id_detalle_repuesto_deposito_judicial','desc')
	      							->get();
               /* $repuestos = repuesto::join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_repuestos.id_vehiculo')
                                    ->join('users','users.id','=','detalle_asignacion_repuestos.id_responsable')
                                   
                                     ->whereBetween('detalle_asignacion_repuestos.created_at',[$Request->fechaDesde.' 00:00:00',$Request->fechaHasta])
                                      ->where('detalle_asignacion_repuestos.id_responsable','=',Auth::User()->id)
                                     ->select('detalle_asignacion_repuestos.*','vehiculos.dominio','vehiculos.numero_de_identificacion','vehiculos.marca','vehiculos.clase_de_unidad','users.usuario')
                                    ->orderBy('id_detalle_repuesto','desc')
                                    ->get();*/
            }
        }else if($Request->fechaHasta != null and $Request->fechaDesde == null){

            if (strpos(Auth::User()->roles,'Super Admin') || strpos(Auth::User()->roles,'Admin')) {
				$repuestos = repuestosDP::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','detalle_asignacion_repuestos_deposito_judicial.id_vehiculo_deposito_judicial')
	      							->join('users','users.id','=','detalle_asignacion_repuestos_deposito_judicial.id_responsable')
	                                ->select('detalle_asignacion_repuestos_deposito_judicial.*','vehiculos_deposito_judicial.dominio_deposito_judicial','vehiculos_deposito_judicial.numero_de_referencia_aleatorio_deposito_judicial','vehiculos_deposito_judicial.marca_deposito_judicial','vehiculos_deposito_judicial.clase_de_unidad_deposito_judicial','users.usuario')
	                                ->whereBetween('detalle_asignacion_repuestos_deposito_judicial.created_at',['2020-01-01 23:59:59',$Request->fechaHasta.' 23:59:59'])
	      							->orderBy('id_detalle_repuesto_deposito_judicial','desc')
	      							->get();
/*
                $repuestos = repuesto::join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_repuestos.id_vehiculo')
                                    ->join('users','users.id','=','detalle_asignacion_repuestos.id_responsable')
                                   
                                     ->whereBetween('detalle_asignacion_repuestos.created_at',[$Request->fechaDesde.' 00:00:00',$Request->fechaHasta])
                                      
                                     ->select('detalle_asignacion_repuestos.*','vehiculos.dominio','vehiculos.numero_de_identificacion','vehiculos.marca','vehiculos.clase_de_unidad','users.usuario')
                                    ->orderBy('id_detalle_repuesto','desc')
                                    ->get();*/
            }else{
				$repuestos = repuestosDP::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','detalle_asignacion_repuestos_deposito_judicial.id_vehiculo_deposito_judicial')
	      							->join('users','users.id','=','detalle_asignacion_repuestos_deposito_judicial.id_responsable')
	                                ->select('detalle_asignacion_repuestos_deposito_judicial.*','vehiculos_deposito_judicial.dominio_deposito_judicial','vehiculos_deposito_judicial.numero_de_referencia_aleatorio_deposito_judicial','vehiculos_deposito_judicial.marca_deposito_judicial','vehiculos_deposito_judicial.clase_de_unidad_deposito_judicial','users.usuario')
	                                ->where('detalle_asignacion_repuestos_deposito_judicial.id_responsable','=',Auth::User()->id)
	                                ->whereBetween('detalle_asignacion_repuestos_deposito_judicial.created_at',['2020-01-01 00:00:00',$Request->fechaHasta.' 00:00:00'])
	      							->orderBy('id_detalle_repuesto_deposito_judicial','desc')
	      							->get();
               /* $repuestos = repuesto::join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_repuestos.id_vehiculo')
                                    ->join('users','users.id','=','detalle_asignacion_repuestos.id_responsable')
                                   
                                     ->whereBetween('detalle_asignacion_repuestos.created_at',[$Request->fechaDesde.' 00:00:00',$Request->fechaHasta])
                                      ->where('detalle_asignacion_repuestos.id_responsable','=',Auth::User()->id)
                                     ->select('detalle_asignacion_repuestos.*','vehiculos.dominio','vehiculos.numero_de_identificacion','vehiculos.marca','vehiculos.clase_de_unidad','users.usuario')
                                    ->orderBy('id_detalle_repuesto','desc')
                                    ->get();*/
            }
        }else if($Request->vehiculoBuscado != null and $Request->fechaDesde == null and $Request->fechaHasta == null){
			$repuestos = repuestosDP::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','detalle_asignacion_repuestos_deposito_judicial.id_vehiculo_deposito_judicial')
      							->join('users','users.id','=','detalle_asignacion_repuestos_deposito_judicial.id_responsable')
      							->where('vehiculos_deposito_judicial.numero_de_identificacion_deposito_judicial','ilike',$Request->vehiculoBuscado)
                                ->orwhere('vehiculos_deposito_judicial.dominio_deposito_judicial','ilike',$Request->vehiculoBuscado)
                                ->select('detalle_asignacion_repuestos_deposito_judicial.*','vehiculos_deposito_judicial.dominio_deposito_judicial','vehiculos_deposito_judicial.numero_de_referencia_aleatorio_deposito_judicial','vehiculos_deposito_judicial.marca_deposito_judicial','vehiculos_deposito_judicial.clase_de_unidad_deposito_judicial','users.usuario')
      							->orderBy('id_detalle_repuesto_deposito_judicial','desc')
      							->get();
/*            $repuestos = repuesto::join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_repuestos.id_vehiculo')
                                ->join('users','users.id','=','detalle_asignacion_repuestos.id_responsable')
                                ->where('vehiculos.numero_de_identificacion','ilike',$Request->vehiculoBuscado)
                                ->orwhere('vehiculos.dominio','ilike',$Request->vehiculoBuscado)
                                ->select('detalle_asignacion_repuestos.*','vehiculos.dominio','vehiculos.numero_de_identificacion','vehiculos.marca','vehiculos.clase_de_unidad','users.usuario')
                                ->orderBy('id_detalle_repuesto','desc')
                                ->get();*/

        }

        $repuestos = $this->paginar($repuestos);
        return view('deposito_judicial.repuestos.repuestos_alta_listado',compact('repuestos'));
    }




    public function AsignarRepuestoDP(Request $Request){
    	
        $fechaActual=date('Y-m-d');
       ;
        $Validar = \Validator::make($Request->all(), [
            
            'id_vehiculo' => 'required',
            'fecha'=>'required|before_or_equal:'.$fechaActual,
            'repuestos_entregados' => 'required',
           /* 'pdfrepuestos' => 'required|mimes:pdf'
*/
        ]);

        if ($Validar->fails()){
            alert()->error('Error','Intente cargar neuvamente ...');
           return  back()->withInput()->withErrors($Validar->errors());
        }
   
        $vehiculo_asignado_repuesto = new repuestosDP;
        $vehiculo_asignado_repuesto->id_vehiculo_deposito_judicial = $Request->id_vehiculo;
        $vehiculo_asignado_repuesto->fecha_deposito_judicial = $Request->fecha;
        $vehiculo_asignado_repuesto->repuestos_entregados_deposito_judicial = $Request->repuestos_entregados;
        $vehiculo_asignado_repuesto->pdf_nombre_deposito_judicial = 'no posee';
        $vehiculo_asignado_repuesto->id_responsable = Auth::User()->id;



        if($vehiculo_asignado_repuesto->save()){
             return $this->getMensaje('Asignado con exito','indexDPRepuestos',true); 
        }else{
            return $this->getMensaje('Ups...! Ocurrio un error, intente nuevamente','indexDPRepuestos',false);
        } 
       
    }

    public function editarRepuestoDP(Request $Request){
        $Validar = \Validator::make($Request->all(), [
            
            'repuestos_entregados_editar' => 'required'
        ]);

        if ($Validar->fails()){
            alert()->error('Error','Intente cargar neuvamente ...');
           return  back()->withInput()->withErrors($Validar->errors());
        }
        $vehiculos_repuestos_asignados_editado = repuestosDP::findorfail($Request->id_detalle_repuesto);

        $vehiculos_repuestos_asignados_editado->repuestos_entregados_deposito_judicial = $Request->repuestos_entregados_editar;

        if($vehiculos_repuestos_asignados_editado->update()){

             return $this->getMensaje('Editado con éxito','indexDPRepuestos',true); 
        }else{
            return $this->getMensaje('Ups...! Ocurrio un error, intente nuevamente','indexDPRepuestos',false);
        } 

    }
    
    public function getAllVehiculosDisponiblesRepuestosDP(Request $Request){
        $vehiculos_disponibles = \DB::select("select * 
        									from vehiculos_deposito_judicial    
                                            where dominio_deposito_judicial ilike '%".$Request->termino."%' 
                                            or numero_de_referencia_aleatorio_deposito_judicial ilike '%".$Request->termino."%' 
                                            and baja_deposito_judicial != 2" );

        return response()->json($vehiculos_disponibles);

    }

    public function exportarPdfRepuestosDP($id){
    	$vehiculos_repuestos_asignados = repuestosDP::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','detalle_asignacion_repuestos_deposito_judicial.id_vehiculo_deposito_judicial')
  							->join('users','users.id','=','detalle_asignacion_repuestos_deposito_judicial.id_responsable')
  							->where('detalle_asignacion_repuestos_deposito_judicial.id_detalle_repuesto_deposito_judicial','=',$id)
  							->orderBy('id_detalle_repuesto_deposito_judicial','desc')
  							->get();

        $pdf = PDF::loadView('deposito_judicial.repuestos.pdf_repuestos_asignados', compact('vehiculos_repuestos_asignados'));

        return $pdf->download($vehiculos_repuestos_asignados[0]->dominio_deposito_judicial.'.pdf');
    }
    //tratamiento para descargar el pdf.
    protected function downloadFile($src){
        if(is_file($src)){
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $content_type = finfo_file($finfo, $src);
            finfo_close($finfo);
            $file_name = basename($src).PHP_EOL;
            $size = filesize($src);
            header("Content-Type: $content_type");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: $size");
            readfile($src);
            return true;
        } else{
            return false;
        }
    }

    public function descargaPdfSiniestro($nombre){
        if(!$this->downloadFile(storage_path()."/app/public/pdf/pdf_siniestros/".$nombre)){
            return redirect()->back();
        }
    }
}
