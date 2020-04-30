<?php

namespace App\Http\Controllers\deposito_judicial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Validation\Rule;

//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Image;
use File;
use Response;
//modelos
use App\Modelos\vehiculo_deposito_judicial;
use App\Modelos\imagen_judicial_vehiculo;
use App\Modelos\tipos_vehiculos;
use App\Modelos\marca;
use App\Modelos\estado_vehiculo_deposito_judicial;
use App\Modelos\asignacion_vehiculo_deposito_judicial;

class DepositoJudicialController extends Controller
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

        //return view('mantenimiento');
        $tipo_vehiculo = tipos_vehiculos::all();
        $marca = marca::all();

        if ($Request->vehiculoBuscado == null ) {

            $vehiculosDepositoJudicial = vehiculo_deposito_judicial::leftjoin('marcas','marcas.id_marca','=','vehiculos_deposito_judicial.marca_deposito_judicial')
                                                                    ->join('juzgados','juzgados.id_juzgado','=','vehiculos_deposito_judicial.id_juzgado')
                                                                    ->orderBy('id_vehiculo_deposito_judicial','desc')
                                                                    ->get();
          
        }else{

            $vehiculosDepositoJudicial = vehiculo_deposito_judicial::leftjoin('marcas','marcas.id_marca','=','vehiculos_deposito_judicial.marca_deposito_judicial')
                                                                    ->join('juzgados','juzgados.id_juzgado','=','vehiculos_deposito_judicial.id_juzgado')
                                                                    ->where('numero_de_carpeta_deposito_judicial','ilike',$Request->vehiculoBuscado)
                                                                    ->orwhere('numero_de_identificacion_deposito_judicial','ilike',$Request->vehiculoBuscado)
                                                                    ->orderBy('id_vehiculo_deposito_judicial','desc')->get();
            
        }

        //return $vehiculosDepositoJudicial;
       
        $vehiculosDepositoJudicial = $this->paginar($vehiculosDepositoJudicial);

       // return $vehiculosDepositoJudicial;
		return view('deposito_judicial.deposito_judicial',compact('vehiculosDepositoJudicial','tipo_vehiculo','marca'));
	}



    //funcion que utilizamos para crear o editar
    private function vehiculoCreacionEdicion($datos,$vehiculo,$accion){
       // return $datos;
       
        $vehiculo->numero_de_identificacion_deposito_judicial = $datos->numero_de_identificacion;
        $vehiculo->fecha_deposito_judicial = $datos->fecha;
        
        if ($datos->juzgado_alta == null) {
            $vehiculo->id_juzgado = $vehiculo->id_juzgado;
        }else{
           $vehiculo->id_juzgado = $datos->juzgado_alta; 
        }


        $vehiculo->clase_de_unidad_deposito_judicial = $datos->clase_de_unidad;
        $vehiculo->marca_deposito_judicial = $datos->marca;
        $vehiculo->modelo_deposito_judicial = $datos->modelo;
        $vehiculo->chasis_deposito_judicial = $datos->chasis;
        $vehiculo->motor_deposito_judicial = $datos->motor;
        $vehiculo->anio_de_produccion_deposito_judicial = $datos->anio_produccion;
        $vehiculo->dominio_deposito_judicial = $datos->dominio;
        $vehiculo->kilometraje_deposito_judicial = $datos->kilometraje;
        $vehiculo->numero_de_carpeta_deposito_judicial = $datos->numero_de_carpeta_deposito_judicial;
        $vehiculo->otras_caracteristicas_deposito_judicial = $datos->otros;
        $vehiculo->tipo_deposito_judicial = $datos->tipo;
        $vehiculo->id_usuario = Auth::User()->id;



       //return $datos;
        switch ($accion) {
            case 0: //creacion --> alta

                $vehiculo->save();

                if ($datos->foto == null) {
                    alert()->success( 'Creacion con éxito, sin fotos');
                    return  redirect()->route('indexDepositoJudicial');
                }else{
                    $images = $datos->file('foto');

                    Storage::disk('public')->makeDirectory('imagenes/judicial/'.$vehiculo->id_vehiculo_deposito_judicial);
                    foreach($images as $image){
                        $imagenvehiculo = new imagen_judicial_vehiculo;

                        $nombre_archivo_nuevo = time().$image->getClientOriginalName();

                        Image::make($image)->resize(300, 500);
                       
                        Storage::disk("public")->put($nombre_archivo_nuevo, file_get_contents($image));
                        Storage::move("public/".$nombre_archivo_nuevo, "public/imagenes/judicial/".$vehiculo->id_vehiculo_deposito_judicial.'/'.$nombre_archivo_nuevo);
                        
                        $imagenvehiculo->id_vehiculo_deposito_judicial = $vehiculo->id_vehiculo_deposito_judicial;
                        $imagenvehiculo->nombre_imagen = $nombre_archivo_nuevo;
                        $imagenvehiculo->fecha =  $datos->fecha;
                        $imagenvehiculo->save();
                    }
                    return $this->getMensaje('Creado con exito','indexDepositoJudicial',true);
                    break; 
                }

            case 1: //edicion
               
                $vehiculo->update();
                if($datos->foto == null){
                    alert()->success( 'Edicion con éxito, sin fotos');
                    return  redirect()->route('indexDepositoJudicial');
                }else{
                   $vehiculo_delete_imagen = imagen_judicial_vehiculo::where('id_vehiculo_deposito_judicial','=',$datos->id_vehiculo_deposito_judicial)->get();
                  
                   if (!isset($vehiculo_delete_imagen[0]->nombre_imagen) ) {
                        Storage::disk('public')->makeDirectory('imagenes/judicial/'.$vehiculo->id_vehiculo_deposito_judicial);
                    }else{
                        foreach ($vehiculo_delete_imagen as $item) {
                            unlink(storage_path('app/public/imagenes/judicial/'.$vehiculo->id_vehiculo_deposito_judicial.'/'.$item->nombre_imagen));
                            $item->delete();
                        }  
                    }

                   
                    $images = $datos->file('foto');

                    foreach($images as $image){
                        $imagenvehiculo = new imagen_judicial_vehiculo;

                        $nombre_archivo_nuevo = time().$image->getClientOriginalName();

                        Image::make($image)->resize(300, 500);
                       
                        Storage::disk("public")->put($nombre_archivo_nuevo, file_get_contents($image));
                        Storage::move("public/".$nombre_archivo_nuevo, "public/imagenes/judicial/".$vehiculo->id_vehiculo_deposito_judicial.'/'.$nombre_archivo_nuevo);
                        
                        $imagenvehiculo->id_vehiculo_deposito_judicial = $vehiculo->id_vehiculo_deposito_judicial;
                        $imagenvehiculo->nombre_imagen = $nombre_archivo_nuevo;
                        $imagenvehiculo->fecha =  $datos->fecha;
                        $imagenvehiculo->save();
                    }
                }

                return $this->getMensaje('Actualizado con exito','indexDepositoJudicial',true);
                break;
             default:
                return $this->getMensaje('Intente nuevamente','indexDepositoJudicial',false);
        }
    }



    //alta nuevo vehiculo
    public function crearVehiculoDepositoJudicial(Request $Request){

       // return $Request;
        
        $Validar = \Validator::make($Request->all(), [
            
            'numero_de_identificacion' => 'required',
            'juzgado_alta' => 'required',
            'dominio'    => 'required',
            'chasis' => 'max:20|required',
            'motor' => 'max:20|required',
            'modelo' => 'max:20|required',
            'marca' => 'max:50|required',
            'kilometraje' => 'max:50|required',
            'anio_produccion' => 'max:50|required',
            'tipo' => 'required',
            /*"foto.*" => 'required|image|mimes:jpeg,jpg',*/
            'fecha' => 'required',
            'numero_de_carpeta_deposito_judicial' => 'required|unique:vehiculos_deposito_judicial',
            'clase_de_unidad' => 'max:20|required'
        ]);

        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...')->persistent('Aceptar');
            return  back()->withInput()->withErrors($Validar->errors());
        }
    
        $nuevoVehiculoDepositoJudicial = new vehiculo_deposito_judicial;

        return  $this->vehiculoCreacionEdicion($Request,$nuevoVehiculoDepositoJudicial,0);//0 creacion
    }

    protected function generate_numbers($start, $count, $digits) {
       $result = array();
       for ($n = $start; $n < $start + $count; $n++) {
          $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
       }
       return $result;
    }
  
    //actualizacion de vehiculo cargado (edicion)
    public function editarVehiculo(Request $Request){

        $fechaActual=date('Y-m-d');


        //return $Request;
        
        $Validar = \Validator::make($Request->all(), [
            
            'numero_de_identificacion' => 'required',
            'fecha' => 'required|before_or_equal:'.$fechaActual,
            //'juzgado_alta' => 'required',
            'dominio'    => 'required',
            'chasis' => 'max:20|required',
            'motor' => 'max:20|required',
            'modelo' => 'max:20|required',
            'marca' => 'max:50|required',
            'kilometraje' => 'max:50|required',
            'anio_produccion' => 'max:50|required',
            'tipo' => 'required',
            //"foto.*" => 'required|image|mimes:jpeg,jpg',
            'numero_de_carpeta_deposito_judicial' => ['required',
                                               Rule::unique('vehiculos_deposito_judicial')
                                               ->ignore($Request->id_vehiculo_deposito_judicial,'id_vehiculo_deposito_judicial')],
            'clase_de_unidad' => 'max:20|required'
        ]);

        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...')->persistent('Aceptar');
            return  back()->withInput()->withErrors($Validar->errors());
        }

        $vehiculo_en_actualizacion= vehiculo_deposito_judicial::findorfail($Request->id_vehiculo_deposito_judicial);
        
        return  $this->vehiculoCreacionEdicion($Request,$vehiculo_en_actualizacion,1);//1 edicioN

    }


    public function fueraDeServicioDepositoJudicial(Request $Request){

        $Validar = \Validator::make($Request->all(), [
            'motivo_de_baja' => 'required|max:255'
        ]);

        if ($Validar->fails()){
            alert()->error('Error','Intente eliminar neuvamente ...');
           return  back()->withInput()->withErrors($Validar->errors());
        }

        $vehiculoEliminado = vehiculo_deposito_judicial::findOrFail($Request->id_vehiculo_baja_deposito_judicial);
        //return $vehiculoEliminado;
        $vehiculoEliminado->baja_deposito_judicial = 1;
       // return $vehiculoEliminado;
        $vehiculoEliminado->Delete();
        $vehiculoEnProceso = new estado_vehiculo_deposito_judicial;

        $vehiculoEnProceso->id_vehiculo_deposito_judicial = $Request->id_vehiculo_baja_deposito_judicial;
        $vehiculoEnProceso->tipo_estado_vehiculo_deposito_judicial = 1; //fuera de servicio
     
        $vehiculoEnProceso->id_usuario_movimiento = Auth::User()->id;
        $vehiculoEnProceso->estado_razon_deposito_judicial = $Request->motivo_de_baja;
        $vehiculoEnProceso->estado_fecha_deposito_judicial = date('Y-m-d H:i:s', strtotime($Request->fecha));//$Request->fecha;
     //   return $vehiculoEnProceso;

        if( ($vehiculoEnProceso->save() && $vehiculoEliminado->update() )){
            return $this->getMensaje('Vehiculo puesto fuera de servicio exitosamente','indexDepositoJudicial',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','indexDepositoJudicial',false);
        } 

    }

	public function getAllJuzgados(Request $Request){
        $posible_afectado = \DB::select("select * from juzgados where nombre_juzgado ilike '%".$Request->termino."%'");

        return response()->json($posible_afectado);

	}



    public function indexDetalle(Request $Request,$id = null){
        if (Auth::User()->primer_logeo == null) {
            return redirect('/primerIngreso');
        }

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        
        if ($id == null && $Request->vehiculoBuscado == null) {
            $existe = 0;
            $VehiculosListados = 0;
            $siniestros = 0;
            $asignacion_actual = 0;
            $imagenes_vehiculo = 0;
            $historial = 0;
        }elseif($id != null && $Request->vehiculoBuscado == null){

           
            $existe = 1;
            $VehiculosListados = vehiculo_deposito_judicial::where('id_vehiculo_deposito_judicial','=',$id)->get();
       
/*            $siniestros = $this->Siniestros($id);
            $historial = $this->HistorialVehiculo($id);
            $asignacion_actual = $this->AsignacionActual($id);*/
            $imagenes_vehiculo = imagen_judicial_vehiculo::where('id_vehiculo_deposito_judicial','=',$id)->select('nombre_imagen')->get();
            

/*
            if (count($asignacion_actual)> 0) {
                if ($asignacion_actual[0]->id_dependencia == 392) {
                    $Mandatario_Dignatario = $this->Mandatario_Dignatario($asignacion_actual[0]->id_detalle);
                }
            }
            */
            
        }elseif( $Request->vehiculoBuscado != null && $id == null){

            /*$vehiculo = \DB::select("select id_vehiculo from vehiculos where numero_de_identificacion = '".$Request->vehiculoBuscado."' or dominio = '".$Request->vehiculoBuscado."'");*/
            $vehiculo = vehiculo_deposito_judicial::where('numero_de_referencia_aleatorio_deposito_judicial','=',$Request->vehiculoBuscado)
                                                            ->orwhere('dominio_deposito_judicial','=',$Request->vehiculoBuscado)
                                                            ->select('id_vehiculo_deposito_judicial')
                                                            ->get();
            

            if (count($vehiculo)>0) {
                $existe = 1;
              // return $vehiculo;
                /*$historial = $this->HistorialVehiculo($vehiculo[0]->id_vehiculo);
                $asignacion_actual = $this->AsignacionActual($vehiculo[0]->id_vehiculo);
                $siniestros = $this->Siniestros($vehiculo[0]->id_vehiculo);*/
                $imagenes_vehiculo = imagen_judicial_vehiculo::where('id_vehiculo_deposito_judicial','=',$vehiculo[0]->id_vehiculo_deposito_judicial)->select('nombre_imagen')->get();
                $VehiculosListados = vehiculo_deposito_judicial::where('id_vehiculo_deposito_judicial','=',$vehiculo[0]->id_vehiculo_deposito_judicial)->get();
                
/*
            if (count($asignacion_actual)> 0) {
                if ($asignacion_actual[0]->id_dependencia == 392) {
                    $Mandatario_Dignatario = $this->Mandatario_Dignatario($asignacion_actual[0]->id_detalle);
                }
            }
*/
            }else{
                $existe = 0;
            }
        }
        
        return view('deposito_judicial.detalles.detalle_vehiculo',compact('existe','VehiculosListados','imagenes_vehiculo'));
    }

    public function ImagenDP($carpeta,$archivo){

        $path = storage_path('app/public/imagenes/judicial/'.$carpeta.'/'.$archivo);
     
        if (!File::exists($path)) {

            abort(404);

        }
        
        $file = File::get($path);

        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);

        return $response;
    }
}
