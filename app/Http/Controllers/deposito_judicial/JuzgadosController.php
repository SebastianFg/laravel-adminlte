<?php

namespace App\Http\Controllers\deposito_judicial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\softDeletes;

//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

//modelos
use App\Modelos\Juzgado;

class JuzgadosController extends Controller
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
        if ($Request->juzgadoBuscado != null) {
             $listaJuzgado = Juzgado::where('nombre_juzgado','like','%'.$Request->juzgadoBuscado.'%')
                                    ->orwhere('direccion_juzgado','like','%'.$Request->juzgadoBuscado.'%')
                                    ->orderBy('id_juzgado','desc')
                                    ->get();
        }else{
            $listaJuzgado = Juzgado::orderBy('id_juzgado','desc')->get();
        }
        
        $listaJuzgado = $this->paginar($listaJuzgado);
     
       // return $vehiculosDeposistoJudicial;
		return view('deposito_judicial.juzgados.juzgados',compact('listaJuzgado'));
	}

	public function altaJuzgado(Request $Request){

        $Validar = \Validator::make($Request->all(), [
            
            'nombre_juzgado' => 'required|unique:juzgados',
            'direccion_juzgado' => 'required',
            'telefono_juzgado'    => 'required|unique:juzgados',
            'responsable_juzgado' => 'required|unique:juzgados',
        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }

        $juzgado = new Juzgado;
        return  $this->juzgadoCreacionEdicion($Request,$juzgado,0);//0 creacion
	}

	public function editarJuzgado(Request $Request){

        $Validar = \Validator::make($Request->all(), [
            'nombre_juzgado' => ['required',Rule::unique('juzgados')->ignore($Request->nombre_juzgado,'nombre_juzgado')],
            'direccion_juzgado' => ['required',Rule::unique('juzgados')->ignore($Request->direccion_juzgado,'direccion_juzgado')],
            'telefono_juzgado' => ['required',Rule::unique('juzgados')->ignore($Request->telefono_juzgado,'telefono_juzgado')],
            'responsable_juzgado' => ['required',Rule::unique('juzgados')->ignore($Request->responsable_juzgado,'responsable_juzgado')],
        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }

        $juzgadoEdicion = Juzgado::findorfail($Request->id_juzgado);
        return  $this->juzgadoCreacionEdicion($Request,$juzgadoEdicion,1);//1 edicion
	}

	public function eliminarJuzgado(Request $Request){


        $juzgadoBorrado = Juzgado::findorfail($Request->id_juzgado_eliminar);

        if($juzgadoBorrado->delete()){
            return $this->getMensaje('Eliminado con éxito','indexJuzgado',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','indexJuzgado',false);
        } 
	}

    //funcion que utilizamos para crear o editar
	private function juzgadoCreacionEdicion($datos,$juzgado,$accion){

        $juzgado->nombre_juzgado = $datos->nombre_juzgado;
        $juzgado->direccion_juzgado = $datos->direccion_juzgado;
        $juzgado->telefono_juzgado = $datos->telefono_juzgado;
        $juzgado->responsable_juzgado = $datos->responsable_juzgado;


        switch ($accion){
            case 0: //creacion --> alta
                if($juzgado->save()){
		            return $this->getMensaje('Creado con éxito','indexJuzgado',true);           
		        }else{
		            return $this->getMensaje('Verifique y Intente nuevamente','indexJuzgado',false);
		        } 

            case 1: // edicion
		        if($juzgado->update()){
		            return $this->getMensaje('Actualizado con éxito','indexJuzgado',true);           
		        }else{
		            return $this->getMensaje('Verifique y Intente nuevamente','indexJuzgado',false);
		        } 
        }
    }

}
