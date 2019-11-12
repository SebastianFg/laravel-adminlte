<?php

namespace App\Http\Controllers\dependencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


//modelos

use App\modelos\dependencia;

class DependenciaController extends Controller
{

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

		//return $Request->nivel_dependencia;
		
		//$lista_roles = Permission::with('Roles:id,name')->get();
		
		if ($Request->nombreDependencia == null && $Request->nivel_dependencia == null ) {
        	$dependencias = dependencia::orderBy('dep.id_dependencia')->join('dependencias as dep','dep.id_padre_dependencia','=','dependencias.id_dependencia')->select('dependencias.nombre_dependencia as padre','dep.nombre_dependencia as hijo')->get();
        	$dependencias = $this->paginar($dependencias);
        	$existe = 1;
	      	//return $dependencias;
        }else{
        	
        	if (isset($Request->nombreDependencia)) {
        		$dependencias = dependencia::Dependecia($Request->nombreDependencia);
        	}else{
        		$dependencias = dependencia::Dependecia($Request->nivel_dependencia);
        	}
        	

        	$dependencias = $this->paginar($dependencias);
        	$existe = 1;
        }

    	return view('dependencias.dependencias',compact('dependencias','existe'));
    }
}
