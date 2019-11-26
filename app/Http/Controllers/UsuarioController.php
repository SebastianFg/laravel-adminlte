<?php

namespace App\Http\Controllers;

//laravel
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

//modelos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\modelos\user_baja;

class UsuarioController extends Controller
{
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
    protected function quitarRoles($usuarios){
    	//return $usuarios->id;
		$roles = User::with('Roles:id,name')->orderBy('id')->where('id','=',$usuarios->id)->get();

		foreach ($roles[0]->roles as $key){
			//buscamos el rol con su respectivo ID
			$role = Role::findById($key->id);
			
			//sacamos el rol al usuario
			$usuarios->removeRole($role->name);
		} 
	

    }
	public function index(Request $Request){
		
        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }
		//return $Request;
		$usuarios = User::with('Roles:id,name')->orderBy('id')->get();
		//$lista_roles = Permission::with('Roles:id,name')->get();
		$lista_roles = Role::all();
		if ($Request->usuarioBuscado ==null ) {
        	$usuarios = User::with('Roles:id,name')->orderBy('id')->get();
        	$usuarios = $this->paginar($usuarios);
        	$existe = 1;
	      
        }else{

   
        	$usuarios = User::buscarUsuario($Request->usuarioBuscado);

        	$usuarios = $this->paginar($usuarios);
        	$existe = 1;
        }
       	return view('usuarios.usuarios',compact('usuarios','lista_roles','existe'));
    }

	public function asignarRol(Request $Request){

		$usuarios = User::findorfail($Request->usuario);
		
		if (strpos($usuarios->getRoleNames(),'Admin')) {
          
            return $this->getMensaje('No se puede modificar un usuario administracion','listaUsuarios',false);
        }
        sss
		

		if ($Request->nombre != null) {
			$usuarios->nombre = $Request->nombre;
		}
		if ($Request->nombre_usuario_id != null) {
			$usuarios->usuario = $Request->nombre_usuario_id;
		}

		if ($usuarios->update()) {
			$usuarios->syncRoles($Request->role);
			return $this->getMensaje('Rol asignado con exito','listaUsuarios',true);
		}else{
			return $this->getMensaje('Algo fallo... intente nuevamente','listaUsuarios',false);
		}

	
		
/*
		$usuarios->syncRoles($Request->role);
		return $usuarios;*/
		/*if ($this->quitarRoles($usuarios)) {
			return $this->getMensaje('No se puede borrar a el usuario administrador','listaUsuarios',false);
		}else{

			foreach ($Request->role as $key){
				//buscamos el rol con su respectivo ID
				$role = Role::findById($key);
				//asignamos al usuario el respectivo Rol
				$usuarios->assignRole($role->name);
			} 
		}*/
		
	}

	public function eliminarUsuario(Request $Request){
        $Validar = \Validator::make($Request->all(), [
            'motivo_de_baja' => 'required|max:255'
        ]);

        if ($Validar->fails()){
            alert()->error('Error','Intente eliminar neuvamente ...');
           return  back()->withInput()->withErrors($Validar->errors());
        }

		$usuario_dado_de_baja = User::findorfail($Request->id_usuario);


		if (strpos($usuario_dado_de_baja->getRoleNames(),'Admin')) {
          
            return $this->getMensaje('No se puede modificar un usuario administracion','listaUsuarios',false);
        }else{
			$this->quitarRoles($usuario_dado_de_baja);
			$usuario_dado_de_baja->Delete();

			$usuario_baja = new user_baja;

			$usuario_baja->motivo = $Request->motivo_de_baja;
			$usuario_baja->id_usuario_movimiento = $Request->id_usuario_movimiento;
			$usuario_baja->id_usuario= $Request->id_usuario;

	        if(($usuario_baja->save() and  $usuario_dado_de_baja->update())){
	            return $this->getMensaje('Usuario dado de baja correctamente','listaUsuarios',true);           
	        }else{
	            return $this->getMensaje('Verifique y Intente nuevamente','listaUsuarios',false);
	        } 
        }



		if ($this->quitarRoles($usuario_dado_de_baja)) {
			return $this->getMensaje('No se puede borrar a el usuario administrador','listaUsuarios',false);
		}else{

			$usuario_dado_de_baja->Delete();

			$usuario_baja = new user_baja;

			$usuario_baja->motivo = $Request->motivo_de_baja;
			$usuario_baja->id_usuario_movimiento = $Request->id_usuario_movimiento;
			$usuario_baja->id_usuario= $Request->id_usuario;

	        if(($usuario_baja->save() and  $usuario_dado_de_baja->update())){
	            return $this->getMensaje('Usuario dado de baja correctamente','listaUsuarios',true);           
	        }else{
	            return $this->getMensaje('Verifique y Intente nuevamente','listaUsuarios',false);
	        } 
   		}
	}
}
