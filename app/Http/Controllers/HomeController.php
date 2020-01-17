<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//modelos
use App\Modelos\dependencias;
use App\Modelos\vehiculo;
use App\Modelos\tipos_vehiculos;
use App\user;
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

        if ($Request->vehiculoBuscado != null && ($Request->marca && $Request->anio && $Request->id_tipo_vehiculo_lista) == null) {

            $vehiculoBuscado = vehiculo::where('dominio','ilike','%'.$Request->vehiculoBuscado.'%')
                                        ->orwhere('numero_de_identificacion','ilike','%'.$Request->vehiculoBuscado.'%')->get();

            return view('welcome',compact('marca','anios','tipo_vehiculo','vehiculoBuscado'));

        }elseif($Request->marcas != null  && ($Request->vehiculoBuscado && $Request->anio && $Request->id_tipo_vehiculo_lista) == null){

            $vehiculoBuscado = vehiculo::where('marca','ilike','%'.$Request->marcas.'%')->get();
           // return $Request->marca;
            return view('welcome',compact('marca','anios','tipo_vehiculo','vehiculoBuscado'));

        }elseif($Request->anio != null  &&($Request->vehiculoBuscado && $Request->marca && $Request->id_tipo_vehiculo_lista) == null){

            $vehiculoBuscado = vehiculo::where('anio_de_produccion','=',$Request->anio)->get();
            return view('welcome',compact('marca','anios','tipo_vehiculo','vehiculoBuscado'));

        }elseif($Request->id_tipo_vehiculo_lista != null  && ($Request->vehiculoBuscado && $Request->marca && $Request->anio) == null){

            $vehiculoBuscado = vehiculo::where('tipo','=',$Request->id_tipo_vehiculo_lista)->get();
           // return $vehiculoBuscado;
            return view('welcome',compact('marca','anios','tipo_vehiculo','vehiculoBuscado'));
        }
        return view('welcome',compact('marca','anios','tipo_vehiculo'));  
       
    }  
}
