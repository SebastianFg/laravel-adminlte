<?php

namespace App\Http\Controllers\vehiculos;

//laravel
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
//modelos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\modelos\tipos_vehiculos;
use App\modelos\vehiculo;
use App\modelos\pdf_Estado;
use App\modelos\imagen_vehiculo;
use App\modelos\estado_vehiculo;
use App\User;
//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

//pdf
use Barryvdh\DomPDF\Facade as PDF;
class VehiculoController extends Controller
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
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////// VEHICULOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index(Request $Request){
        if (Auth::User()->primer_logeo == null) {
            return redirect('admin/primerIngreso');
        }

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }


        $tipo_vehiculo = tipos_vehiculos::all();
       /* $existe = 1;*/

        if ($Request->vehiculoBuscado ==null && $Request->id_tipo_vehiculo_lista ==null ) {
        	$VehiculosListados = vehiculo::join('tipos_vehiculos','tipos_vehiculos.id_tipo_vehiculo','=','vehiculos.tipo')
                                                ->select('vehiculos.*','tipos_vehiculos.*')->orderBy('vehiculos.id_vehiculo','desc')->get();
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


    //funcion que utilizamos para crear o editar
	private function vehiculoCreacionEdicion($datos,$vehiculo,$accion){

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


        switch ($accion) {
            case 0: //creacion --> alta
            	$vehiculo->save();
                $images = $datos->file('foto');
                
                foreach($images as $image)
                {
                    $imagenvehiculo = new imagen_vehiculo;
                    $nuevo_nombre =time().'_'.$image->getClientOriginalName();

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
                    $images = $datos->file('foto');
  
                    foreach($images as $image){
                        $imagenvehiculo = new imagen_vehiculo;

                        $nuevo_nombre =time().'_'.$image->getClientOriginalName();
     
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
            'marca' => 'required|max:50',
            'anio_produccion' => 'required|numeric',
            'tipo' => 'required',
            'numero_de_inventario' => 'required|unique:vehiculos',
            'clase_de_unidad' => 'required|max:20',
            'tipo' => 'required',
            'otros' => 'required',
            'foto' => 'required'
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

        $vehiculo_en_actualizacion= vehiculo::findorfail($Request->vehiculo);
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
            return $this->getMensaje('Vehiculo puesto fuera de servicio exitosamente','listaVehiculos',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','listaVehiculos',false);
        } 

    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////// ESTADOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function indexEstadoFueraServicio(Request $Request){

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        if ($Request->vehiculoBuscado ==null) {

           // $estados_listado = \DB::select('select * from view_vehiculos_en_reparacion');
            $estados_listado = \DB::select('select * FROM vehiculos
                                             JOIN ( SELECT max(estado_vehiculos_1.id_estado_vehiculo) AS maxestado,
                                                    estado_vehiculos_1.id_vehiculo
                                                   FROM estado_vehiculos estado_vehiculos_1
                                                  WHERE estado_vehiculos_1.tipo_estado_vehiculo = 1
                                                  GROUP BY estado_vehiculos_1.id_vehiculo) r ON r.id_vehiculo = vehiculos.id_vehiculo
                                             JOIN estado_vehiculos ON r.maxestado = estado_vehiculos.id_estado_vehiculo
                                          WHERE vehiculos.baja = 1');                                    
           $estados_listado = $this->paginar($estados_listado);

          
        }else{

            $estados_listado = estado_vehiculo::BuscarFueraDeServicio($Request->vehiculoBuscado);
            $estados_listado = $this->paginar($estados_listado);

        }

        return view('vehiculos.estados.estado_fuera_de_servicio_vehiculos',compact('estados_listado'));

    }

    public function indexEstadoBajaDefinitiva(Request $Request){

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        if ($Request->vehiculoBuscado ==null) {
            $estados_listado = estado_vehiculo::join('vehiculos','vehiculos.id_vehiculo','=','estado_vehiculos.id_vehiculo')
                                                ->select('vehiculos.*','estado_vehiculos.*')
                                                ->orderBy('estado_vehiculos.id_estado_vehiculo','desc')
                                                ->where('vehiculos.baja','=',2)
                                                ->where('estado_vehiculos.tipo_estado_vehiculo','=',2)
                                                ->get();
            $estados_listado = $this->paginar($estados_listado);
          
        }else{

            $estados_listado = estado_vehiculo::BuscarBajaDefinitiva($Request->vehiculoBuscado);


            $estados_listado = $this->paginar($estados_listado);

        }
        return view('vehiculos.estados.estado_baja_definitiva_vehiculos',compact('estados_listado'));
    }

    public function indexEstadoHistorialCompleto(Request $Request){

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        if ($Request->vehiculoBuscado ==null) {
            $estados_listado = estado_vehiculo::join('vehiculos','vehiculos.id_vehiculo','=','estado_vehiculos.id_vehiculo')
                                                ->select('vehiculos.*','estado_vehiculos.*')
                                                ->orderBy('estado_vehiculos.id_estado_vehiculo','desc')
                                                ->get();
            $estados_listado = $this->paginar($estados_listado);
          
        }else{

            $estados_listado = estado_vehiculo::BuscarHistorialCompleto($Request->vehiculoBuscado);

            $estados_listado = $this->paginar($estados_listado);

        }
        return view('vehiculos.estados.estado_historial_completo_vehiculos',compact('estados_listado'));
    }
    public function estadoVehiculoAlta(Request $Request){

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        $Validar = \Validator::make($Request->all(), [
            
            'motivo_de_alta' => 'required',
        ]);

        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }



        $vehiculoEliminado= vehiculo::withTrashed()->where('id_vehiculo','=',$Request->id_vehiculo_reparado)->restore();
        $vehiculoEliminado= vehiculo::findorfail($Request->id_vehiculo_reparado);
        //return $vehiculo_en_actualizacion;
        $vehiculoEliminado->baja = 0;
        //$vehiculoEliminado->restore();;

        $vehiculoEnProceso = new estado_vehiculo;

        $vehiculoEnProceso->id_vehiculo = $Request->id_vehiculo_reparado;
        $vehiculoEnProceso->tipo_estado_vehiculo = 0; //fuera de servicio
     
        $vehiculoEnProceso->id_usuario_movimiento = Auth::User()->id;;
        $vehiculoEnProceso->estado_razon = $Request->motivo_de_alta;
        $vehiculoEnProceso->estado_fecha = $Request->fecha;


        if(($vehiculoEnProceso->save() and  $vehiculoEliminado->update())){
            return $this->getMensaje('Vehiculo reparado exitosamente','listaVehiculos',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','listaVehiculos',false);
        } 
    }

    public function bajaDefinitiva(Request $Request){
       // return $Request;
        $Validar = \Validator::make($Request->all(), [
            'motivo_de_baja_definitiva' => 'required|max:255',
            'pdf_decreto_baja_definitiva' => 'required|mimes:pdf'
        ]);

        if ($Validar->fails()){
            alert()->error('Error','Intente eliminar neuvamente ...');
           return  back()->withInput()->withErrors($Validar->errors());
        }

        $vehiculoEliminado= vehiculo::withTrashed()->where('id_vehiculo','=',$Request->id_vehiculo_baja)->restore();
        $vehiculoEliminado= vehiculo::findorfail($Request->id_vehiculo_baja);
       
        $vehiculoEliminado->baja = 2;
        $vehiculoEliminado->delete();
        $vehiculoEliminado->update();

        $vehiculoEnProceso = new estado_vehiculo;

        $vehiculoEnProceso->id_vehiculo = $Request->id_vehiculo_baja;
        $vehiculoEnProceso->tipo_estado_vehiculo = 2; //fuera de servicio
     
        $vehiculoEnProceso->id_usuario_movimiento = Auth::User()->id;
        $vehiculoEnProceso->estado_razon = $Request->motivo_de_baja_definitiva;
        $vehiculoEnProceso->estado_fecha = $Request->fecha;

        if($Request->hasFile('pdf_decreto_baja_definitiva')){

            $file = $Request->file('pdf_decreto_baja_definitiva');
            $nombre_archivo_nuevo = time().$file->getClientOriginalName();
            $file->move(public_path().'/pdf/',$nombre_archivo_nuevo);
            
            $pdfEstado = new pdf_Estado;
           // return $pdfEstado;
            $pdfEstado->nombre_pdf_estado = $nombre_archivo_nuevo;
            $pdfEstado->id_estado_vehiculo = $Request->id_vehiculo_estado;
            $pdfEstado->save();
            
        }

        if($vehiculoEnProceso->save() && $pdfEstado->save()){
            return $this->getMensaje('Vehiculo dado de baja definitivamente exitosamente','listaVehiculos',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','listaVehiculos',false);
        } 
    }

    public function getAllVehiculos(Request $Request){
        
        $vehiculos_disponibles = \DB::select("select * from vehiculos
                                            inner join detalle_asignacion_vehiculos on detalle_asignacion_vehiculos.id_vehiculo = vehiculos.id_vehiculo
                                            where  vehiculos.dominio ilike '%".$Request->termino."%' or vehiculos.numero_de_identificacion ilike '%".$Request->termino."%' 
                                            and vehiculos.baja != 2" );

        return response()->json($vehiculos_disponibles);

    }
    public function exportarPdfVehiculos(){

        $detalle_asignacion_vehiculo = vehiculo::join('detalle_asignacion_vehiculos','detalle_asignacion_vehiculos.id_vehiculo','=','vehiculos.id_vehiculo')
                                ->join('dependencias','dependencias.id_dependencia','=','detalle_asignacion_vehiculos.id_dependencia')
                                ->join('tipos_vehiculos','tipos_vehiculos.id_tipo_vehiculo','=','vehiculos.tipo')
                                ->get();
      //   return $detalle_asignacion_vehiculo;

       // return $vehiculos;

        //return $dato;
/*        $detalle_asignacion_vehiculo = \DB::select("select * from view_total_afectados  
                                                inner join tipo_vehiculos on view_total_afectados.tipo = tipo_vehiculos.id_tipo_vehiculo
                                                where baja = 0 and  tipo_vehiculos.id_tipo_vehiculo ='".$dato."'"); 
        //return $detalle_asignacion_vehiculo;
        if (($detalle_asignacion_vehiculo == null)) {
            $detalle_asignacion_vehiculo = \DB::select("select * from vehiculos  
                                                inner join tipo_vehiculos on vehiculos.tipo = tipo_vehiculos.id_tipo_vehiculo 
                                                where baja = 0 and  tipo_vehiculos.id_tipo_vehiculo ='".$dato."'");
        }*/
       
        $cantidad_total ='CANTIDAD TOTAL: '. count($detalle_asignacion_vehiculo );

        $pdf = PDF::loadView('vehiculos.altas.altas_exportar_pdf',compact('detalle_asignacion_vehiculo','cantidad_total'));//->setPaper('legal', 'landscape');
        $pdf->setPaper('legal', 'landscape');
        return $pdf->download('lista completa de vehiculos.pdf');
    }
}
