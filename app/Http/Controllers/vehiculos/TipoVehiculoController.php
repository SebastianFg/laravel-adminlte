<?php

namespace App\Http\Controllers\vehiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

//Modelos
use App\Modelos\tipos_vehiculos;

class TipoVehiculoController extends Controller
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


        if ($Request->tipoVehiculoBuscado ==null) {
        	$tipo_vehiculo = tipos_vehiculos::orderby('id_tipo_vehiculo','desc')->get();

        	$tipo_vehiculo = $this->paginar($tipo_vehiculo);
	      
        }else{

        	if (isset($Request->tipoVehiculoBuscado)) {
        		$tipo_vehiculo = tipos_vehiculos::TipoVehiculo($Request->tipoVehiculoBuscado);
        	}

        	$tipo_vehiculo = $this->paginar($tipo_vehiculo);

        }
		return view('vehiculos.tipo_vehiculo.tipos_vehiculos',compact('tipo_vehiculo'));
	}

	public function crearTipoVehiculo(Request $Request){
        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        $Validar = \Validator::make($Request->all(), [
            
            'nombre_tipo_vehiculo' => 'required|unique:tipos_vehiculos'
        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }

        $tipo_vehiculo = new tipos_vehiculos;

        $tipo_vehiculo->nombre_tipo_vehiculo = $Request->nombre_tipo_vehiculo;

        if($tipo_vehiculo->save()){
            return $this->getMensaje('Tipo de vehiculo creado  exitosamente','listaTipoVehiculos',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','listaTipoVehiculos',false);
        } 
	}

	public function editarTipoVehiculo(Request $Request){
		
        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        $Validar = \Validator::make($Request->all(), [
            
            'nombre_tipo_vehiculo' => 'required|unique:tipos_vehiculos'
        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
        }

        $tipo_vehiculo = tipos_vehiculos::findorfail($Request->id_tipo_vehiculo);
  
        $tipo_vehiculo->nombre_tipo_vehiculo = $Request->nombre_tipo_vehiculo_editar;

        if($tipo_vehiculo->save()){
            return $this->getMensaje('Tipo de vehiculo creado  exitosamente','listaTipoVehiculos',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','listaTipoVehiculos',false);
        } 
	}

	public function eliminarTipoVehiculo(Request $Request){

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        $tipo_vehiculo = tipos_vehiculos::findorfail($Request->id_tipo_vehiculo);

        $tipo_vehiculo->Delete();

        if($tipo_vehiculo->save()){
            return $this->getMensaje('Tipo de vehiculo eliminado exitosamente','listaTipoVehiculos',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','listaTipoVehiculos',false);
        } 
	}
}
