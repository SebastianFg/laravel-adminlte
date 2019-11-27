<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//modelos
use App\modelos\dependencias;
use App\modelos\vehiculo;
use App\modelos\tipos_vehiculos;
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
            return redirect('admin/primerIngreso');
        }


        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
           // return redirect('/login');
        }

/*        $usuario = User::findorfail(Auth::User()->id);
        return $usuario;    
        if ($usuario->primer_logeo == null) {
            return redirect('admin/primerPassword');
        }*/

        $anios = vehiculo::select('anio_de_produccion')->orderBy('anio_de_produccion','asc')->get();
        $marca = vehiculo::select('marca')->orderBy('marca','asc')->get();
        $tipo_vehiculo = tipos_vehiculos::all();
        //return $Request->id_tipo_vehiculo_lista;

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



     /*   $role = Role::findById(1);
        $permission = Permission::findById(6);
        $role->givePermissionTo($permission);*/
         //auth()->user()->givePermissionTo('listaVehiculos');
       // return User::role('Admin')->get();
       // return auth()->user()->getAllPermissions();
      /*  $dependencias = dependencias::all();
        $anios =DB::table('vehiculos')->select('anio_de_produccion')->distinct()->orderBy('anio_de_produccion','asc')->get();// \DB::select('SELECT distinct anio_de_produccion FROM vehiculos ORDER BY anio_de_produccion asc');
        $marca =   $anios =DB::table('vehiculos')->select('marca')->distinct()->orderBy('marca','asc')->get();//  \DB::select('SELECT distinct marca FROM vehiculos  ORDER BY marca asc');
        */
       // return view('dashboard/index',compact('dependencias','marca','anios'));
        /*if ($Request = null) {
        }else{
            return view('welcome',compact('direcciones_generales','marca','anios'));
        }*/

    
}
