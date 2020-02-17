<?php

namespace App\Http\Controllers;

//laravel
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use DateTime;

//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

//modelos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Modelos\user_baja;

//imagen
use Illuminate\Support\Facades\Storage;
use Image;

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

        if (Auth::User()->primer_logeo == null) {
            return redirect('/primerIngreso');
        }
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

		if (Auth::User()->roles[0]->name != 'Super Admin' and strpos(Auth::User()->roles,'Super Admin') == true){

            return $this->getMensaje('Error! Ud. no tiene permiso para asignar este rol','listaUsuarios',false);
        }

		$usuarios = User::findorfail($Request->usuario);


		if (strpos($usuarios->getRoleNames(),'Super Admin')) {
            return $this->getMensaje('No se puede modificar un usuario Super Admin','listaUsuarios',false);
        }

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


		if (strpos($usuario_dado_de_baja->getRoleNames(),'Super Admin')) {
          
            return $this->getMensaje('No se puede modificar un usuario Super Admin','listaUsuarios',false);
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
	}

	public function resetPassword($id){
		$usuarios = User::findorfail($id);
		$usuarios->password = 'informatica2019++';
		$usuarios->primer_logeo = null;
		//return $usuarios;
		if ($usuarios->update()) {
			return $this->getMensaje('password puesto por default correctamente','listaUsuarios',true);
		}else{
			return $this->getMensaje('Verifique e intente nuevamente','listaUsuarios',false);
		}

		 
	}

	public function registroUsuario(Request $Request){
		//return $Request;
        $Validar = \Validator::make($Request->all(), [
            
            'usuario' => 'required|unique:users',
        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }

        $nuevoUsuario = new User;

        
        $nuevoUsuario->usuario = 'pol'.$Request->usuario;
        $nuevoUsuario->imagen_perfil = 'avatar_default.png';
        $passwordNueva = 'informatica2019++';

        $nuevoUsuario->password = $passwordNueva;

        /*prueba*/

        $url = "http://sistemas.policiamisiones.gob.ar:8081/api/revistas.php?revista=".$Request->usuario;
        $json = @file_get_contents($url);
        $obj = json_decode($json, true);
        $foto = $obj[0]["foto"]; //Muesto Fotografia
        $jerarquia =  $obj[0]["jerarquia"];
        $nombre =  $obj[0]["nombres"];
        $apellido =  $obj[0]["apellido"];
      //  $url = "http://sistemas.policiamisiones.gob.ar:8081/api/revistas.php?revista=16043";
        $nuevoUsuario->nombre = $apellido.' '.$nombre;
     // dd($nuevoUsuario);




        if ($nuevoUsuario->save()) {
        	$nuevoUsuario->syncRoles('Sin Rol');
        	return $this->getMensaje('Usuario creado correctamente','listaUsuarios',true);
        }else{
        	return $this->getMensaje('Error... verifique e intente nuevamente','listaUsuarios',false);
        }

	}

    public function jerarquia(Request $Request){

        $url = "http://sistemas.policiamisiones.gob.ar:8081/api/revistas.php?revista=".$Request->Revista;
        $json = @file_get_contents($url);
        $obj = json_decode($json, true);
        $jerarquia[1] = $obj[0]["foto"]; //Muesto Fotografia
        $jerarquia[0] =  $obj[0]["jerarquia"];
        return $jerarquia;

    }
	public function primerPassword(){

		return view('auth.primer_password');
	}

	public function cambioPrimerPassword(Request $Request){

        $Validar = \Validator::make($Request->all(), [
            
            'password_nueva' => 'required',
            'password_confirmation' => 'required',
        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }


        $passwordActual = Auth::User()->password;

        $passwordNueva = $Request->password_nueva;
       
        if(Hash::check( $passwordNueva, $passwordActual ) ) {
        	return $this->getMensaje('la contraseña ingresada debe ser diferente al actual','primerPassword',false);
        }

        if ($Request->password_confirmation != $Request->password_nueva) {
        	return $this->getMensaje('la contraseñas ingresadas deben coincidir ','primerPassword',false);
        }

        $usuario = User::findorfail(Auth::User()->id);
        $usuario->password = $passwordNueva;
        $usuario->primer_logeo =  new DateTime('today');

        if ($usuario->update()) {
        	return $this->getMensaje('Actualizado correctamente','inicio',true);
        }else{
        	return $this->getMensaje('Verifique e intente nuevamente','primerPassword',false);
        }
	}

    public function editarPerfil(Request $Request){

    
            if ($Request->foto != null){
                $Validar = \Validator::make($Request->all(), [
                    'foto' => 'required|image|mimes:jpg,jpeg'
                ]);

                if ($Validar->fails()){
                    alert()->error('Error','Error... debe subir una imagen');
                   return  back()->withInput()->withErrors($Validar->errors());
                }


                if ($Request->file('foto')->isValid()) {
                    $avatar = $Request->file('foto');
                    $usuario_imgen = User::where('id','=',Auth::User()->id)->select('imagen_perfil')->get();
                    if ($usuario_imgen[0]->imagen_perfil != 'avatar_default.png') {
                        unlink(storage_path('app/public/imagenes/avatar/'.$usuario_imgen[0]->imagen_perfil));
                        $usuario_imgen[0]->delete();
                    }

                    $nombre_archivo_nuevo = time() . '-' . $avatar->getClientOriginalName();


                    Image::make($avatar)->resize(300, 300);
                   
                    Storage::disk("public")->put($nombre_archivo_nuevo, file_get_contents($avatar));
                    Storage::move("public/".$nombre_archivo_nuevo, "public/imagenes/avatar/".$nombre_archivo_nuevo);

                    $usuario_foto = User::findorfail(Auth::User()->id);
                    $usuario_foto->imagen_perfil = $nombre_archivo_nuevo;
                    $usuario_foto->update();
                    }
                }
            

            if (($Request->password_nueva && $Request->password_confirmation) != null) {
                
                $passwordActual = Auth::User()->password;

                $passwordNueva = $Request->password_nueva;

                if(Hash::check( $passwordNueva, $passwordActual ) ) {
                    return $this->getMensaje('la contraseña ingresada debe ser diferente al actual','inicio',false);
                }

                if ($Request->password_confirmation != $Request->password_nueva) {
                    return $this->getMensaje('la contraseñas ingresadas deben coincidir ','inicio',false);
                }

                $usuario = User::findorfail(Auth::User()->id);

                $usuario->password = $passwordNueva;
                $usuario->update();

            }   
            return $this->getMensaje('Perfil actualizado con exito','inicio',true);
  
    }
}
