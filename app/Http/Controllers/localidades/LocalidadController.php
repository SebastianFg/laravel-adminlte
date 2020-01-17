<?php

namespace App\Http\Controllers\localidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//modelos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Modelos\Localidad;
use App\User;

//librerias
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Support\Facades\Auth;
//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
class LocalidadController extends Controller
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

	public function index(Request $Request){

        if (Auth::User()->primer_logeo == null) {
            return redirect('/primerIngreso');
        }

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }
		$localidades = Localidad::orderBy('id_localidad','desc')->get();
        $localidades = $this->paginar($localidades);


		return view('localidades.localidad',compact('localidades'));
	}



	public function crearLocalidad(Request $Request){

        $Validar = \Validator::make($Request->all(), [
            
            'nombre_localidad' => 'required|unique:localidades',

        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }

        $nuevaLocalidad = new Localidad;

        $nuevaLocalidad->nombre_localidad = $Request->nombre_localidad;


        if($nuevaLocalidad->save()){
            return $this->getMensaje('Localdiad guardada con exito','indexLocalidades',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','indexLocalidades',false);
        } 
	}

	public function eliminarLocalidad(Request $Request){
		return $Request;
	}
}
