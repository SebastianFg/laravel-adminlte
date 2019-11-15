<?php

namespace App\Http\Controllers\vehiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\modelos\asignacion_vehiculo;
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

        $asignacion = asignacion_vehiculo::join('dependencias','dependencias.id_dependencia','=','detalle_asignacion_vehiculos.id_dependencia')
        									->join('vehiculos','vehiculos.id_vehiculo','=','detalle_asignacion_vehiculos.id_vehiculo')->get();
       // return $asignacion;
/*	
        if ($Request->tipoVehiculoBuscado ==null) {
        	$tipo_vehiculo = tipos_vehiculos::all();
        	$tipo_vehiculo = $this->paginar($tipo_vehiculo);
	      
        }else{

        	if (isset($Request->tipoVehiculoBuscado)) {
        		$tipo_vehiculo = tipos_vehiculos::TipoVehiculo($Request->tipoVehiculoBuscado);
        	}

        	$tipo_vehiculo = $this->paginar($tipo_vehiculo);

        }*/
		return view('vehiculos.asignacion.asignar_vehiculos',compact('asignacion'));
	}
}
