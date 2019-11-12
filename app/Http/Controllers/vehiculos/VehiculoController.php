<?php

namespace App\Http\Controllers\vehiculos;

//laravel
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
//modelos

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\modelos\tipos_vehiculos;
use App\modelos\vehiculo;
use App\modelos\imagen_vehiculo;
use App\modelos\estado_vehiculo;
use App\User;
//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
class VehiculoController extends Controller
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

        $tipo_vehiculo = tipos_vehiculos::all();
        $existe = 1;

        if ($Request->vehiculoBuscado ==null && $Request->id_tipo_vehiculo_lista ==null ) {
        	$VehiculosListados = vehiculo::all();
        	$VehiculosListados = $this->paginar($VehiculosListados);
	      
        }else{

        	if (isset($Request->vehiculoBuscado)) {
        		$VehiculosListados = vehiculo::Identificacion($Request->vehiculoBuscado);
        	}else{
        		$VehiculosListados = vehiculo::Identificacion($Request->id_tipo_vehiculo_lista);
        	}

        	$VehiculosListados = $this->paginar($VehiculosListados);

        }
         return view('vehiculos.altas.alta_vehiculos',compact('tipo_vehiculo','VehiculosListados','existe'));
    }
	private function vehiculoCreacionEdicion($datos,$vehiculo,$accion){

			//return $datos;

        $vehiculo->numero_de_identificacion = $datos->numero_de_identificacion;
        $vehiculo->fecha = $datos->fecha;
        $vehiculo->dominio = $datos->dominio;
        $vehiculo->chasis = $datos->chasis;
        $vehiculo->motor = $datos->motor;
        $vehiculo->modelo = $datos->modelo;
        $vehiculo->marca = $datos->marca;
        $vehiculo->anio_de_produccion = $datos->anio_produccion;
        $vehiculo->numero_de_inventario = $datos->numero_de_inventario;
        $vehiculo->clase_de_unidad = $datos->clase_de_unidad;
        $vehiculo->tipo = $datos->tipo;

        if ($accion == 0 || $datos->kilometraje == null) {
        	$vehiculo->kilometraje = 0;
        }else if($accion == 1){
        	$vehiculo->kilometraje = $datos->kilometraje;
        }
        $vehiculo->otras_caracteristicas = $datos->otros;

       /* if( $vehiculo->save()){*/
            switch ($accion) {
                case 0: //creacion --> alta
                	$vehiculo->save();
                    $images = $datos->file('file');
                    
                    foreach($images as $image)
                    {
                        $imagenvehiculo = new imagen_vehiculo;
                        $nuevo_nombre =time().'_'.$image->getClientOriginalName();
                       // $image = Image::make($image)->resize(150,150);
                        $image->move(public_path('images'), $nuevo_nombre);
                        $imagenvehiculo->id_vehiculo = $vehiculo->id_vehiculo;
                        $imagenvehiculo->nombre_imagen = $nuevo_nombre;
                        $imagenvehiculo->fecha =  $datos->fecha;
                        $imagenvehiculo->save();
                    }
                 
                    alert()->success( 'Creacion con exito');
                    return  redirect()->route('listaVehiculos');
                    break;
                case 1: // edicion
                	$vehiculo->update();
                    if($datos->file == null){
                            $vehiculo->foto_id = $vehiculo->foto_id;
                    }else{ 
                        $images = $datos->file('file');
                       // return $images;
                        foreach($images as $image){
                            $imagenvehiculo = new imagen_vehiculo;

                            $nuevo_nombre =time().'_'.$image->getClientOriginalName();
                           // $image = Image::make($image)->resize(150,150);
                            $image->move(public_path('images'), $nuevo_nombre);
                            $imagenvehiculo->id_vehiculo = $datos->id_vehiculo;;
                            $imagenvehiculo->nombre_imagen = $nuevo_nombre;
                            $imagenvehiculo->fecha =  $datos->fecha;
                            $imagenvehiculo->save();
                        }
                    }
                    return $this->getMensaje('Actualizado con exito','listaVehiculos',true);
                    break;
                 default:
                 	return $this->getMensaje('Intente nuevamente','listaVehiculos',false);
            }
/*            }else{
            return $this->getMensaje('Intente nuevamente','listaVehiculos',false);

        } */
    }


    //alta nuevo vehiculo
    public function crearVehiculo(Request $Request){
        
        $Validar = \Validator::make($Request->all(), [
            
            'numero_de_identificacion' => 'required|unique:vehiculos',
            'fecha' => 'required',
            'dominio'    => 'required|unique:vehiculos',
            'chasis' => 'required|unique:vehiculos|max:20',
            'motor' => 'required|unique:vehiculos|max:20',
            'modelo' => 'required|max:20',
            'marca' => 'required|max:20',
            'anio_produccion' => 'required|numeric',
            'tipo' => 'required',
            'numero_de_inventario' => 'required|unique:vehiculos',
            'clase_de_unidad' => 'required|max:20',
            'tipo' => 'required',
            'otros' => 'required',
            'file' => 'required'
        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }

        $vehiculoNuevo = new Vehiculo;
        return  $this->vehiculoCreacionEdicion($Request,$vehiculoNuevo,0);//0 creacion
    }
  
    //actualizacion de vehiculo cargado (edicion)
    public function updateVehiculo(Request $Request){

    	//dd($Request);
        $Validar = \Validator::make($Request->all(), [
              
            'numero_de_identificacion' => ['required',
                                               Rule::unique('vehiculos')->ignore($Request->numero_de_identificacion,'numero_de_identificacion')],
            'fecha' => 'required',
            'dominio'    => ['required',
                              Rule::unique('vehiculos')->ignore($Request->dominio,'dominio')],
            'chasis' =>  ['required',
                              Rule::unique('vehiculos')->ignore($Request->chasis,'chasis')],
            'motor' => ['required',
                              Rule::unique('vehiculos')->ignore($Request->motor,'motor')],
            'modelo' => 'required|max:20',
            'marca' => 'required|max:20',
            'anio_produccion' => 'required|numeric',
            'kilometraje' => 'required',
            'clase_de_unidad' => 'required|max:20',
            'otros' => 'required'
        ]);
        if ($Validar->fails()){
            alert()->error('Error','Agrege nuevamente...no');
            return  back()->withInput()->withErrors($Validar->errors());
        }

        $vehiculo_en_actualizacion= vehiculo::find($Request->vehiculo);
       return  $this->vehiculoCreacionEdicion($Request,$vehiculo_en_actualizacion,1);//1 edicioN

    }

    public function fueraDeServicio(Request $Request){

    	//return $Request;
        $Validar = \Validator::make($Request->all(), [
            'motivo_de_baja' => 'required|max:255'
        ]);

        if ($Validar->fails()){
            alert()->error('Error','Intente eliminar neuvamente ...');
           return  back()->withInput()->withErrors($Validar->errors());
        }

        //return $Request;
        $vehiculoEliminado = vehiculo::findOrFail($Request->vehiculo);
        $vehiculoEliminado->baja = 1;
        $vehiculoEliminado->Delete();

        $vehiculoEnProceso = new estado_vehiculo;

        $vehiculoEnProceso->id_vehiculo = $Request->vehiculo;
        $vehiculoEnProceso->tipo_estado_vehiculo = 1; //fuera de servicio
     
        $vehiculoEnProceso->id_usuario_movimiento = $Request->id_usuario;
        $vehiculoEnProceso->estado_razon = $Request->motivo_de_baja;
        $vehiculoEnProceso->estado_fecha = $Request->fecha;


        if(($vehiculoEnProceso->save() and  $vehiculoEliminado->update())){
            return $this->getMensaje('Vehiculo puesto fuera de servicio exitosamente','listadoEstadoVehiculo',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','listadoEstadoVehiculo',false);
        } 

    }

}
