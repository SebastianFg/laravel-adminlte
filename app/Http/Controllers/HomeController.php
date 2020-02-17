<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//modelos
use App\Modelos\dependencia;
use App\Modelos\vehiculo;
use App\Modelos\tipos_vehiculos;
use App\user;

use Artisan;
//adicionales
use Illuminate\Support\Facades\Auth;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $Request)
    {    
        //return 'as';
        if (Auth::User()->primer_logeo == null) {
            return redirect('/primerIngreso');
        }


        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
            return redirect('/login');
        }

        $anios = vehiculo::select('anio_de_produccion')->distinct()->orderBy('anio_de_produccion','asc')->get();
        $marca = vehiculo::select('marca')->distinct()->orderBy('marca','asc')->get();
        $tipo_vehiculo = tipos_vehiculos::all();
        $dependencias = dependencia::select('id_dependencia','nombre_dependencia')->Where('nombre_dependencia','ilike','Unidad Regional'.'%')->orderBy('id_dependencia','desc')->get();

       

        $total_vehiculos_disponibles = \DB::select('SELECT tipos_vehiculos.nombre_tipo_vehiculo,count(vehiculos.*) AS total_vehiculos
                                                    FROM tipos_vehiculos
                                                    JOIN vehiculos ON tipos_vehiculos.id_tipo_vehiculo = vehiculos.tipo AND vehiculos.baja = 0
                                                    GROUP BY tipos_vehiculos.id_tipo_vehiculo');

        $total_vehiculos_reparacion =  \DB::select('select count(*) as "Total",rbaja.totalbaja,r.totalreparacion
                                                from vehiculos,
                                                (select count(*) as "totalbaja" from vehiculos where vehiculos.baja = 2) as rbaja,
                                                (select count(*) as "totalreparacion" from vehiculos where vehiculos.baja = 1) as r
                                                group by rbaja.totalbaja,r.totalreparacion');
        $total_siniestros = \DB::select('select count(*) as totalsiniestro,extract(year from fecha_siniestro) as anio
                                        from siniestros
                                        group by extract(year from fecha_siniestro)
                                        order by anio asc');

        if ($Request->vehiculoBuscado != null && ($Request->marca && $Request->anio && $Request->id_tipo_vehiculo_lista) == null) {

            $vehiculoBuscado = vehiculo::where('dominio','ilike','%'.$Request->vehiculoBuscado.'%')
                                        ->orwhere('numero_de_identificacion','ilike','%'.$Request->vehiculoBuscado.'%')->get();

            return view('welcome',compact('marca','anios','tipo_vehiculo','vehiculoBuscado','total_vehiculos_disponibles','total_vehiculos_reparacion','total_siniestros','dependencias'));

        }elseif($Request->marcas != null  && ($Request->vehiculoBuscado && $Request->anio && $Request->id_tipo_vehiculo_lista) == null){

            $vehiculoBuscado = vehiculo::where('marca','ilike','%'.$Request->marcas.'%')->get();
           // return $Request->marca;
            return view('welcome',compact('marca','anios','tipo_vehiculo','vehiculoBuscado','total_vehiculos_disponibles','total_vehiculos_reparacion','total_siniestros','dependencias'));

        }elseif($Request->anio != null  &&($Request->vehiculoBuscado && $Request->marca && $Request->id_tipo_vehiculo_lista) == null){

            $vehiculoBuscado = vehiculo::where('anio_de_produccion','=',$Request->anio)->get();
            return view('welcome',compact('marca','anios','tipo_vehiculo','vehiculoBuscado','total_vehiculos_disponibles','total_vehiculos_reparacion','total_siniestros','dependencias'));

        }elseif($Request->id_tipo_vehiculo_lista != null  && ($Request->vehiculoBuscado && $Request->marca && $Request->anio) == null){

            $vehiculoBuscado = vehiculo::where('tipo','=',$Request->id_tipo_vehiculo_lista)->get();
           // return $vehiculoBuscado;
            return view('welcome',compact('marca','anios','tipo_vehiculo','vehiculoBuscado','total_vehiculos_disponibles','total_vehiculos_reparacion','total_siniestros','dependencias'));
        }elseif($Request->dependencia_seleccionada != null  && ($Request->id_tipo_vehiculo_lista && $Request->vehiculoBuscado && $Request->marca && $Request->anio) == null){


            $dependencia_buscada = DB::select('select count(*) as cantidad_vehiculos,dependencias.id_padre_dependencia as id_dependencia,r.nombre_dependencia
                from detalle_asignacion_vehiculos as  dav
                inner join dependencias on dependencias.id_dependencia = dav.id_dependencia 
                                        or dependencias.id_padre_dependencia = dav.id_dependencia
                inner join (select nombre_dependencia,id_dependencia
                           from dependencias
                           where id_dependencia = '.$Request->dependencia_seleccionada.') as r on r.id_dependencia = id_padre_dependencia
                where dependencias.id_padre_dependencia = '.$Request->dependencia_seleccionada.'
                group by dependencias.id_padre_dependencia,r.nombre_dependencia');
/*            $dependencia_buscada = DB::select('select count(*) as cantidad_vehiculos , dependencias.id_dependencia,dependencias.nombre_dependencia
                from detalle_asignacion_vehiculos
                inner join dependencias on dependencias.id_dependencia = '.$Request->dependencia_seleccionada.'
                group by dependencias.id_dependencia
                ');*/

            return view('welcome',compact('marca','anios','tipo_vehiculo','vehiculoBuscado','total_vehiculos_disponibles','total_vehiculos_reparacion','total_siniestros','dependencias','dependencia_buscada'));
        }

        return view('welcome',compact('marca','anios','tipo_vehiculo','total_vehiculos_disponibles','total_vehiculos_reparacion','total_siniestros','dependencias'));  
       
    } 

    public function detalleUnidadRegional(Request $Request){
        $detalleUnidadRegional = \DB::select('select *
                        from dependencias
                        inner join (select count(*) as total,id_dependencia
                                    from detalle_asignacion_vehiculos as dav
                                    group by id_dependencia) as r on r.id_dependencia = dependencias.id_dependencia
                        where dependencias.id_dependencia ='.$Request->idDependencia.' or dependencias.id_padre_dependencia ='.$Request->idDependencia);
        return view('detalle_unidad_regional',compact('detalleUnidadRegional'));  
        
    }

    public function limpiarCache(){
       $exitCode = Artisan::call('optimize');
       return $exitCode; 
    }
}
