<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;


class PermisosController extends Controller
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
    public function index(Request $Request)
    {
        if (Auth::User()->primer_logeo == null) {
            return redirect('admin/primerIngreso');
        }
        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
            return redirect('/login');
        }
        $existe = 1;
        if ($Request->permisoBuscado ==null ) {
            $permisos = Permission::orderBy('id','desc')->get();
            $permisos = $this->paginar($permisos);

        }else{
            $permisos = Permission::buscaPermiso($Request->permisoBuscado);

            $permisos = $this->paginar($permisos);

        }
        return view('rolesPermisos.permisos.permisos',compact('permisos','existe'));
    }

    public function crearPermiso(Request $Request){

        $permiso = Permission::create(['name' => $Request->nombre_permiso]);

        if (!$permiso->save()) {
            return $this->getMensaje('Verifique e intente nuevamente','listaPermisos',false);
        }else{
             return $this->getMensaje('Permiso creado con exito','listaPermisos',true);
        }
    }

    public function editarPermiso(Request $Request){
       // return $Request;
        $permiso = Permission::findorfail($Request->id_permiso_edicion);

        $permiso->name = $Request->nombre_permiso;

        if (!$permiso->update()) {
            
            return $this->getMensaje('Verifique e intente nuevamente','listaPermisos',false);
        }else{
            return $this->getMensaje('permiso editado con exito','listaPermisos',true);
        }
    }

    public function eliminarPermiso(Request $Request){
        //return $Request;
         $permiso = Permission::findorfail($Request->id_permiso);

         $permiso->Delete();

        if (!$permiso->update()) {
            
            return $this->getMensaje('Verifique e intente nuevamente','listaPermisos',false);
        }else{
            return $this->getMensaje('Permiso eliminado con exito','listaPermisos',true);
        }
    }

}
