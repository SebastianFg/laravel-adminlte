<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use DB;

//modelos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    protected function getMensaje($mensaje,$destino,$desicion){
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
		$existe = 1;

		if ($Request->rolBuscado ==null ) {
        	$lista_roles = Role::orderBy('id','desc')->get();
        	$lista_roles = $this->paginar($lista_roles);
        	
	      
        }else{
        	$lista_roles = Role::buscaRole($Request->rolBuscado);

        	$lista_roles = $this->paginar($lista_roles);

        }

		return view('rolesPermisos.roles.roles',compact('lista_roles','existe'));
	}

	public function crear(Request $Request){

		$rol = Role::create(['name' => $Request->nombre_rol]);

		return $this->getMensaje('Rol creado con exito','listaRoles',true);
	}

	public function editarRol(Request $Request){

		$rol = Role::findorfail($Request->id_rol);

		$rol->name = $Request->nombre_rol;

		if (!$rol->update()) {
			
			return $this->getMensaje('Verifique e intente nuevamente','listaRoles',false);
		}else{
			return $this->getMensaje('Rol editado con exito','listaRoles',true);
		}
	}
	public function eliminarRol(Request $Request){


		$rol = Role::findorfail($Request->id_rol);

		$rol->Delete();

		if (!$rol->update()) {
			
			return $this->getMensaje('Verifique e intente nuevamente','listaRoles',false);
		}else{
			return $this->getMensaje('Rol eliminado con exito','listaRoles',true);
		}
	}

	//Roles y permisos
	public function rolPermisoIndex(Request $Request ){


		$lista_roles = Role::All();
		$existe = 1;
		
		if ($Request->RolPermisoBuscado ==null ) {
        	$lista_roles_permisos = Permission::with('Roles:id,name')->orderBy('id','desc')->get();
        	$lista_roles_permisos = $this->paginar($lista_roles_permisos);

        }else{

        	$lista_roles_permisos = Permission::buscarPermisoRol($Request->RolPermisoBuscado);
        	$lista_roles_permisos = $this->paginar($lista_roles_permisos);
        }

		return view('rolesPermisos.rolesPermisos',compact('lista_roles_permisos','lista_roles','existe'));
	}

	public function editarRolPermiso(Request $Request){
		
		$permiso = Permission::find($Request->id_permiso);
		$permiso->syncRoles($Request->role);

		return redirect()->route('rolPermisos');
	}
}
