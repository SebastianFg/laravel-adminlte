<?php

namespace App\Http\Controllers\vehiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\modelos\asignacion_vehiculo;
use App\modelos\dependencia;
use App\modelos\vehiculo;






use Illuminate\Database\Eloquent\softDeletes;

//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class AsignacionController extends Controller
{
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

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        $lista_dependencias = dependencia::all();
       

        $asignacion = asignacion_vehiculo::join('dependencias','dependencias.id_dependencia','=','detalle_asignacion_vehiculos.id_dependencia')
        									->join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_vehiculos.id_vehiculo')->get();

		return view('vehiculos.asignacion.asignar_vehiculos',compact('asignacion'));
	}

    public function getAllVehiculosDisponibles(Request $Request){
        $vehiculos_disponibles = \DB::select("select * from view_vehiculos_disponibles 
                                            
                                            where view_vehiculos_disponibles.dominio ilike '%".$Request->termino."%' or view_vehiculos_disponibles.numero_de_identificacion ilike '%".$Request->termino."%'" );

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

        $nueva_asignacion = new asignacion_vehiculo;

        $nueva_asignacion->id_vehiculo = $Request->vehiculo;
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
}
