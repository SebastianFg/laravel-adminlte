<?php

namespace App\Http\Controllers\deposito_judicial;

use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

//modelos
use App\Modelos\vehiculo_deposito_judicial;
use App\Modelos\dependencia;
use App\Modelos\Juzgado;
class DetallesJuzgadosVehiculosController extends Controller
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

         $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Armamos la coleccion con los datos
        $collection = collect($datos);
 
        // definimos cuantos items por magina se mostraran
        $por_pagina = 10;
 
        //armamos el paginador... sin el resolvecurrentpage arma la paginacion pero no mueve el selector
        $datos = new LengthAwarePaginator(
            $collection->forPage(Paginator::resolveCurrentPage() , $por_pagina),
            $collection->count(), $por_pagina,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
        return $datos;
	}

	public function indexVehiculosDepositoJudicial(Request $Request){

        if (Auth::User()->primer_logeo == null) {
            return redirect('/primerIngreso');
        }

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        $anios = vehiculo_deposito_judicial::select('anio_de_produccion_deposito_judicial')
                                            ->distinct()
                                            ->orderBy('anio_de_produccion_deposito_judicial','asc')
                                            ->get();
        $dependencias = dependencia::select('id_dependencia','nombre_dependencia')
                                    ->Where('nombre_dependencia','ilike','Unidad Regional'.'%')
                                    ->orwhere('nombre_dependencia','ilike','Jefatura')
                                    ->orwhere('nombre_dependencia','ilike','Sub Jefatura')
                                    ->orderBy('id_dependencia','desc')->get();
        $juzgados = Juzgado::select('id_juzgado','nombre_juzgado')
                            ->orderBy('id_juzgado','desc')->get();
  

        if ($Request->vehiculoBuscado != null && ($Request->anio && $Request->dependencia_seleccionada) == null) {

            $vehiculoBuscado = vehiculo_deposito_judicial::where('dominio_deposito_judicial','ilike','%'.$Request->vehiculoBuscado.'%')
                                        ->orwhere('numero_de_identificacion_deposito_judicial','ilike','%'.$Request->vehiculoBuscado.'%')
                                        ->orwhere('numero_de_referencia_aleatorio_deposito_judicial','ilike','%'.$Request->vehiculoBuscado.'%')
                                        ->get();

            return view('deposito_judicial.welcome',compact('anios','vehiculoBuscado','dependencias','juzgados'));

        }elseif($Request->anio != null  && ($Request->vehiculoBuscado && $Request->dependencia_seleccionada) == null){
            
            $vehiculoBuscado = vehiculo_deposito_judicial::where('anio_de_produccion_deposito_judicial','=',$Request->anio)
            ->get();

            return view('deposito_judicial.welcome',compact('anios','vehiculoBuscado','dependencias','juzgados'));

        }elseif($Request->juzgado_seleccionado != null  && ($Request->vehiculoBuscado && $Request->dependencia_seleccionada && $Request->anio ) == null){
            
            $vehiculoBuscado = vehiculo_deposito_judicial::join('juzgados','juzgados.id_juzgado','=','vehiculos_deposito_judicial.id_juzgado') 
                                                        ->where('juzgados.id_juzgado','=',$Request->juzgado_seleccionado)
                                                        ->get();

            return view('deposito_judicial.welcome',compact('anios','vehiculoBuscado','dependencias','juzgados'));

        }elseif($Request->dependencia_seleccionada != null  && ($Request->vehiculoBuscado && $Request->anio) == null){

/*
            $dependencia_buscada = DB::select('select count(*) as cantidad_vehiculos,dependencias.id_padre_dependencia as id_dependencia,r.nombre_dependencia
                from detalle_asignacion_vehiculos_deposito_judicial as  dav
                inner join dependencias on dependencias.id_dependencia = dav.id_dependencia 
                                       or dependencias.id_padre_dependencia = dav.id_dependencia
                inner join (select nombre_dependencia,id_dependencia
                           from dependencias
                           where id_dependencia = '.$Request->dependencia_seleccionada.') as r on r.id_dependencia = id_padre_dependencia
                where dependencias.id_padre_dependencia = '.$Request->dependencia_seleccionada.'
                group by dependencias.id_padre_dependencia,r.nombre_dependencia,dav.id_dependencia');*/

            $dependencia_buscada = DB::select('select count(*) as cantidad_vehiculos,dependencias.id_padre_dependencia as id_dependencia,dependencias.nombre_dependencia
                    from detalle_asignacion_vehiculos_deposito_judicial as  dav
                    inner join dependencias on dependencias.id_dependencia = dav.id_dependencia 
                                            or dependencias.id_padre_dependencia = dav.id_dependencia

                    where  dependencias.id_dependencia ='.$Request->dependencia_seleccionada.'
                    group by dependencias.id_padre_dependencia,dependencias.nombre_dependencia');



             return view('deposito_judicial.welcome',compact('anios','vehiculoBuscado','dependencias','dependencia_buscada','juzgados'));
        }
    /*        $dependencia_buscada = DB::select('select count(*) as cantidad_vehiculos,dav.id_vehiculo_deposito_judicial,dependencias.id_padre_dependencia as id_dependencia,r.nombre_dependencia
                from detalle_asignacion_vehiculos_deposito_judicial as  dav
                inner join dependencias on dependencias.id_dependencia = dav.id_dependencia 
                inner join (select nombre_dependencia,id_dependencia
                           from dependencias
                           where id_dependencia = '.$Request->dependencia_seleccionada.') as r on r.id_dependencia = id_padre_dependencia
                where dependencias.id_padre_dependencia = '.$Request->dependencia_seleccionada.'
                group by dependencias.id_padre_dependencia,r.nombre_dependencia,dav.id_vehiculo_deposito_judicial
                ');*/
   /*         $dependencia_buscada = DB::select('select count(*) as cantidad_vehiculos,dependencias.id_padre_dependencia as id_dependencia,r.nombre_dependencia
                from detalle_asignacion_vehiculos_deposito_judicial as  dav
                inner join dependencias on dependencias.id_dependencia = dav.id_dependencia 
                                        or dependencias.id_padre_dependencia = dav.id_dependencia
                inner join (select nombre_dependencia,id_dependencia
                           from dependencias
                           where id_dependencia = '.$Request->dependencia_seleccionada.') as r on r.id_dependencia = id_padre_dependencia
                where dependencias.id_padre_dependencia = '.$Request->dependencia_seleccionada.'
                group by dependencias.id_padre_dependencia,r.nombre_dependencia');


            return view('deposito_judicial.welcome',compact('anios','vehiculoBuscado','dependencias','dependencia_buscada'));
        }*/
/*            $dependencia_buscada = DB::select('select count(*) as cantidad_vehiculos , dependencias.id_dependencia,dependencias.nombre_dependencia
                from detalle_asignacion_vehiculos
                inner join dependencias on dependencias.id_dependencia = '.$Request->dependencia_seleccionada.'
                group by dependencias.id_dependencia
                ');*/
     
       // return $vehiculosDeposistoJudicial;
		return view('deposito_judicial.welcome',compact('dependencias','anios','juzgados'));
	}


    public function detalleUnidadRegionalDP(Request $Request){
        $detalleUnidadRegional = \DB::select('select *
                        from dependencias
                        inner join (select count(*) as total,id_dependencia
                                    from detalle_asignacion_vehiculos_deposito_judicial as dav
                                    group by id_dependencia) as r on r.id_dependencia = dependencias.id_dependencia
                        where dependencias.id_dependencia ='.$Request->idDependencia.' or dependencias.id_padre_dependencia ='.$Request->idDependencia);
        return view('deposito_judicial.detalle_deposito_judicial_unidad_regional',compact('detalleUnidadRegional'));  
        
    }

    public function detalleUnidadRegionalVehiculoDP(Request $Request){
        $detalleUnidadRegionalVehiculos = \DB::select('select * 
                                                from vehiculos_deposito_judicial
                                                inner join detalle_asignacion_vehiculos_deposito_judicial on detalle_asignacion_vehiculos_deposito_judicial.id_vehiculo_deposito_judicial = vehiculos_deposito_judicial.id_vehiculo_deposito_judicial
                                                inner join dependencias on dependencias.id_dependencia = detalle_asignacion_vehiculos_deposito_judicial.id_dependencia
                                                where dependencias.id_dependencia ='.$Request->idDependencia);
        
        return view('deposito_judicial.detalle_unidad_regional_vehiculos_deposito_judicial',compact('detalleUnidadRegionalVehiculos'));  
        
    }
}
