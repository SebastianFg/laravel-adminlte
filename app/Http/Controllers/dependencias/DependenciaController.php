<?php

namespace App\Http\Controllers\dependencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

//trait
use App\Http\Controllers\vehiculos\VehiculoController;

//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

//modelos

use App\Modelos\dependencia;

class DependenciaController extends Controller
{
	
    protected function getMensaje($mensaje,$destino,$desicion){
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
		
		if ($Request->nombreDependencia == null && $Request->nivel_dependencia == null ) {
        	$dependencias = dependencia::orderBy('dep.id_dependencia','desc')->join('dependencias as dep','dep.id_padre_dependencia','=','dependencias.id_dependencia')
        	->select('dependencias.nombre_dependencia as padre','dep.nombre_dependencia as hijo','dep.id_dependencia as id_hijo','dependencias.id_dependencia as id_padre','dep.nivel_dependencia as nivel','dependencias.deleted_at')->whereNull('dep.deleted_at')->get();

            
        	$dependencias = $this->paginar($dependencias);
        	$existe = 1;
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

    public function getDependecias(Request $Request){

    		$dependencias = dependencia::where('nivel_dependencia','<',$Request->idDependenciaPadre)->get();
    		foreach ($dependencias as $dependencia) {
    			$dependenciaArray[$dependencia->id_dependencia] = $dependencia->nombre_dependencia;
    		}
    		return response()->json($dependenciaArray);

    }

    public function altaDependencia(Request $Request){

        $Validar = \Validator::make($Request->all(), [
            
            'nombre_dependencia' => 'required|unique:dependencias',
            'nivel_dependencia' => 'required',
            'dependencia_habilitada_padre'    => 'required'
        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }

    	$dependencia = new dependencia;

    	$dependencia->nombre_dependencia = $Request->nombre_dependencia;
    	$dependencia->nivel_dependencia = $Request->nivel_dependencia;
    	$dependencia->id_padre_dependencia = $Request->dependencia_habilitada_padre;

    	if ($dependencia->save()) {
    		return $this->getMensaje('Creado con exito','indexDependencia',true);
    	}else{
    		return $this->getMensaje('Error, Intente nuevamente...','indexDependencia',false);
    	}

    }
    public function bajaDependencia(Request $Request){

        $Validar = \Validator::make($Request->all(), [
            
            'nombre_dependencia' => 'required',
            'id_dependencia' => 'required',
            'id_nivel'    => 'required'
        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }

        $dependencia_baja = dependencia::findorfail($Request->id_dependencia);
        if ($dependencia_baja->delete()) {
        	return $this->getMensaje('Eliminado con exito','indexDependencia',true);
        }else{
        	return $this->getMensaje('Error, Intente nuevamente...','indexDependencia',false);
        }
    }

    public function editarDependencia(Request $Request){

    	$dependencia_editar = dependencia::findorfail($Request->dependencia_edicion);

    	$dependencia_editar->nombre_dependencia = $Request->nombre_dependencia_edicion;
    	if ($Request->nivel_dependencia_edicion != null) {
    		$dependencia_editar->nivel_dependencia = $Request->nivel_dependencia_edicion;
    		if ($Request->dependencia_habilitada_padre_edicion != null) {
    			$dependencia_editar->id_padre_dependencia = $Request->dependencia_habilitada_padre_edicion;
    		}
    	}

        if ($dependencia_editar->update()) {
        	return $this->getMensaje('Eliminado con exito','indexDependencia',true);
        }else{
        	return $this->getMensaje('Error, Intente nuevamente...','indexDependencia',false);
        }
    }
}
