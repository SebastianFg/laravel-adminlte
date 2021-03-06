<?php

namespace App\Http\Controllers\vehiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\modelos\asignacion_vehiculo;
use App\modelos\dependencia;
use App\modelos\vehiculo;
use App\User;

use Barryvdh\DomPDF\Facade as PDF;




use Illuminate\Database\Eloquent\softDeletes;

//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class AsignacionController extends Controller
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

	public function index(Request $Request){
        if (Auth::User()->primer_logeo == null) {
            return redirect('admin/primerIngreso');
        }
        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

       /* $asignacion = asignacion_vehiculo::join('dependencias','dependencias.id_dependencia','=','detalle_asignacion_vehiculos.id_dependencia')
        									->join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_vehiculos.id_vehiculo')
                                            ->orderBy('id_detalle')->get();*/

      if ($Request->vehiculoBuscado == null) {
        $asignacion = asignacion_vehiculo::join('dependencias','dependencias.id_dependencia','=','detalle_asignacion_vehiculos.id_dependencia')
                                                ->join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_vehiculos.id_vehiculo')
                                                ->orderBy('id_detalle')
                                                ->get();
        $asignacion = $this->paginar($asignacion);
      }else{

        $asignacion = asignacion_vehiculo::join('dependencias','dependencias.id_dependencia','=','detalle_asignacion_vehiculos.id_dependencia')
                                            ->join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_vehiculos.id_vehiculo')
                                            ->where('numero_de_identificacion','ilike',$Request->vehiculoBuscado)
                                            ->orwhere('dominio','ilike',$Request->vehiculoBuscado)
                                            ->orderBy('id_detalle')
                                            ->get();
        $asignacion = $this->paginar($asignacion);
      }
       


		return view('vehiculos.asignacion.asignar_vehiculos',compact('asignacion'));
	}

    public function getAllVehiculosDisponibles(Request $Request){
      /*  $vehiculos_disponibles = \DB::select("select * from view_vehiculos_disponibles 
                                            where view_vehiculos_disponibles.dominio ilike '%".$Request->termino."%' or view_vehiculos_disponibles.numero_de_identificacion ilike '%".$Request->termino."%'" );*/
        $vehiculos_disponibles = \DB::select("select *  
                                            FROM vehiculos
                                            WHERE vehiculos.dominio ilike '%".$Request->termino."%' or vehiculos.numero_de_identificacion ilike '%".$Request->termino."%' and vehiculos.id_vehiculo not IN ( SELECT DISTINCT detalle_asignacion_vehiculos.id_vehiculo
                                                       FROM detalle_asignacion_vehiculos)
                                            AND vehiculos.baja = 0");
        return response()->json($vehiculos_disponibles);

    }
    public function getAllAfectadosDisponibles(Request $Request){
        //return $Request->termino;
        $posibles_afectados = \DB::select("select * from dependencias where nombre_dependencia ilike '%".$Request->termino."%'");

        return response()->json($posibles_afectados);

    }

    public function crearAsignacion(Request $Request){

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
            return redirect('/login');
        }

        $Validar = \Validator::make($Request->all(), [
            
            'id_vehiculo' => 'required|unique:detalle_asignacion_vehiculos'
        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! El vehiculo ya fue asignado previamente...')->autoclose(2300);;
            return  back()->withInput()->withErrors('El vehiculo ya fue asignado previamente...');
        }

        $nueva_asignacion = new asignacion_vehiculo;

        $nueva_asignacion->id_vehiculo = $Request->id_vehiculo;
        $nueva_asignacion->id_dependencia = $Request->afectado;
        $nueva_asignacion->fecha = $Request->fecha;
        $nueva_asignacion->observaciones = $Request->otros;
        $nueva_asignacion->id_responsable = Auth::User()->id;

        if ($nueva_asignacion->save()) {
            return $this->getMensaje('Asignado con exito','listaAsignacion',true);
        }else{
            return $this->getMensaje('Error, Intente nuevamente...','listaAsignacion',false);
        }
    }

    public function eliminarAsignacion(Request $Request){
        $asignacion_a_eliminar = asignacion_vehiculo::findorfail($Request->id_detalle);
        

        if ($asignacion_a_eliminar->forceDelete()) {
            return $this->getMensaje('Eliminado con exito','listaAsignacion',true);
        }else{
            return $this->getMensaje('Error, Intente nuevamente...','listaAsignacion',false);
        };
    }
    public function exportarPdfCargo($id){
           // return $id;
            $detalle_asignacion_vehiculo = asignacion_vehiculo::where('id_vehiculo','=',$id)->get();
             
            $detalleVehiculo = Vehiculo::findOrFail($detalle_asignacion_vehiculo[0]->id_vehiculo);
           // return $detalleVehiculo;
            $user = User::findOrFail($detalle_asignacion_vehiculo[0]->id_responsable);
     
            $nombre_responsable_entrega = $user->name;
            $nombre_responsable_recibio = $detalle_asignacion_vehiculo[0]->destino;

            $pdf = PDF::loadView('vehiculos.asignacion.pdf_cargo_lista', compact('detalleVehiculo','nombre_responsable_entrega','nombre_responsable_recibio'));

            return $pdf->download($detalleVehiculo->dominio.'.pdf');
    }
}
