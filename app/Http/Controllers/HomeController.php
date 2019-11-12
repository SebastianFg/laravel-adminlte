<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//modelos
use App\modelos\dependencias;
use App\modelos\vehiculos;
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
    public function index()
    {   
        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        $role = Role::findById(1);
        $permission = Permission::findById(6);
        $role->givePermissionTo($permission);
         //auth()->user()->givePermissionTo('listaVehiculos');
        return User::role('Admin')->get();
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

    
}
