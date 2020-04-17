<?php

namespace App\Http\Controllers\deposito_judicial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

//modelos
use App\Modelos\Vehiculo_deposito_judicial;
use App\Modelos\asignacion_vehiculo_deposito_judicial;
use App\Modelos\dependencia;
use App\Modelos\mandatario_dignatario_deposito_judicial;
use App\User;

class DepositoJudicialAsignacionController extends Controller
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
            return redirect('/primerIngreso');
        }
        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        if ($Request->vehiculoBuscado == null) {
    		$asignacion = asignacion_vehiculo_deposito_judicial::join('dependencias','dependencias.id_dependencia','=','detalle_asignacion_vehiculos_deposito_judicial.id_dependencia')
                                                ->join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','detalle_asignacion_vehiculos_deposito_judicial.id_vehiculo_deposito_judicial')
                                                ->orderBy('id_detalle_deposito_judicial','desc')
                                                ->get();
        	$asignacion = $this->paginar($asignacion);
        }else{

        	$asignacion = asignacion_vehiculo_deposito_judicial::join('dependencias','dependencias.id_dependencia','=','detalle_asignacion_vehiculos_deposito_judicial.id_dependencia')
                                            ->join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','detalle_asignacion_vehiculos_deposito_judicial.id_vehiculo_deposito_judicial')
                                            ->where('numero_de_referencia_aleatorio_deposito_judicial','ilike',$Request->vehiculoBuscado)
                                            ->orwhere('dominio_deposito_judicial','ilike',$Request->vehiculoBuscado)
                                            ->orderBy('id_detalle_deposito_judicial','desc')
                                            ->get();
        	$asignacion = $this->paginar($asignacion);
     	}
		return view('deposito_judicial.asignacion.asignar_vehiculos',compact('asignacion'));
	}

    public function getAllVehiculosDisponiblesJudiciales(Request $Request){

        $vehiculos_disponibles = \DB::select("select *  
                                            from vehiculos_deposito_judicial as v
                                            WHERE v.dominio_deposito_judicial ilike '%".$Request->termino."%' or v.numero_de_referencia_aleatorio_deposito_judicial ilike '%".$Request->termino."%' and v.id_vehiculo_deposito_judicial not IN ( SELECT DISTINCT id_vehiculo_deposito_judicial
                                                       FROM detalle_asignacion_vehiculos_deposito_judicial)
                                            AND v.baja_deposito_judicial != 2");
        return response()->json($vehiculos_disponibles);

    }

    public function crearAsignacionDepositoJudicial(Request $Request){
    	
        $Validar = \Validator::make($Request->all(), [
            
            'id_vehiculo_deposito_judicial' => 'required|unique:detalle_asignacion_vehiculos_deposito_judicial'
        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! El vehiculo ya fue asignado previamente...s')->autoclose(2300);;
            return  back()->withInput()->withErrors('El vehiculo ya fue asignado previamente...');
        }

        $nueva_asignacion = new asignacion_vehiculo_deposito_judicial;

        $nueva_asignacion->id_vehiculo_deposito_judicial = $Request->id_vehiculo_deposito_judicial;
        $nueva_asignacion->id_dependencia = $Request->afectado;
        $nueva_asignacion->fecha = $Request->fecha;
        $nueva_asignacion->observaciones = $Request->otros;
        $nueva_asignacion->id_responsable = Auth::User()->id;
     
        if ($nueva_asignacion->save()) {

            if ($Request->afectado == 392) {
                $nuevo_mandatario_dignatario = new mandatario_dignatario_deposito_judicial;

                $nuevo_mandatario_dignatario->nombre_entidad = $Request->entidad;
                $nuevo_mandatario_dignatario->nombre_mandatario_dignatario = $Request->persona;
                $nuevo_mandatario_dignatario->id_detalle_deposito_judicial = $nueva_asignacion->id_detalle_deposito_judicial;

                $nuevo_mandatario_dignatario->save();
            }
            return $this->getMensaje('Asignado con exito','listaAsignacionJudicial',true);
        }else{
            return $this->getMensaje('Error, Intente nuevamente...','listaAsignacionJudicial',false);
        }
    }
    public function eliminarAsignacionDepositoJudicial(Request $Request){
        $asignacion_a_eliminar = asignacion_vehiculo_deposito_judicial::findorfail($Request->id_detalle);

        if ($asignacion_a_eliminar->forceDelete()) {
            return $this->getMensaje('Eliminado con exito','listaAsignacionJudicial',true);
        }else{
            return $this->getMensaje('Error, Intente nuevamente...','listaAsignacionJudicial',false);
        };
    }

    public function editarAsignacionDepositoJudicial(Request $Request){
    	
        

        $asignacion_edicion = asignacion_vehiculo_deposito_judicial::findorfail($Request->id_detalle_asignacion_vehiculo);

        if (isset($Request->afectado) && $Request->afectado != null) {
            $asignacion_edicion->id_dependencia =$Request->afectado;
        }
        if (isset($Request->id_vehiculo_deposito_judicial) && $Request->id_vehiculo_deposito_judicial != null ) {
            $asignacion_edicion->id_vehiculo_deposito_judicial = $Request->id_vehiculo_deposito_judicial;
        }

        $asignacion_edicion->id_responsable = Auth::User()->id;

        $asignacion_edicion->fecha = $Request->fecha;
        $asignacion_edicion->observaciones = $Request->otros;

        if ($asignacion_edicion->update()) {

            if ($Request->afectado == 392) {
                $nuevo_mandatario_dignatario = mandatario_dignatario_deposito_judicial::where('id_detalle_deposito_judicial','=',$Request->id_detalle_asignacion_vehiculo)->get();

                $nuevo_mandatario_dignatario->nombre_entidad = $Request->entidad;
                $nuevo_mandatario_dignatario->nombre_mandatario_dignatario = $Request->persona;
                $nuevo_mandatario_dignatario->id_detalle_deposito_judicial = $asignacion_edicion->id_detalle_deposito_judicial;

                $nuevo_mandatario_dignatario->save();
            }
            return $this->getMensaje('Asignado con exito','listaAsignacionJudicial',true);
        }else{
            return $this->getMensaje('Error, Intente nuevamente...','listaAsignacionJudicial',false);
        }
    }
}
