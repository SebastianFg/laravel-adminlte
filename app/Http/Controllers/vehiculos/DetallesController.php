<?php

namespace App\Http\Controllers\vehiculos;

//laravel
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
//modelos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\modelos\tipos_vehiculos;
use App\modelos\vehiculo;
use App\modelos\pdf_Estado;
use App\modelos\imagen_vehiculo;
use App\modelos\estado_vehiculo;
use App\modelos\asignacion_vehiculo;
use App\User;
//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class DetallesController extends Controller
{
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
        $datos= new LengthAwarePaginator(
            $collection->forPage(Paginator::resolveCurrentPage() , $por_pagina),
            $collection->count(), $por_pagina,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
        return $datos;
	}
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////// DETALLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////



    public function index(Request $Request,$id = null){


        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }


        if ($id == null && $Request->vehiculoBuscado == null) {
        	$existe = 0;			
        }elseif($id != null && $Request->vehiculoBuscado == null){
        	$existe = 1;
        	$VehiculosListados = \DB::select('select * from vehiculos where id_vehiculo ='. $id);

        }elseif( $Request->vehiculoBuscado != null && $id == null){
        	$existe = 1;
        	$asignacion_actual = asignacion_vehiculo::join('dependencias','dependencias.id_dependencia','=','detalle_asignacion_vehiculos.id_dependencia')
        											->join('users','detalle_asignacion_vehiculos.id_responsable','=','users.id')->get();
        	$VehiculosListados = \DB::select('select * from vehiculos where id_vehiculo ='. $Request->vehiculoBuscado);
        	//return $asignacion_actual;
        }

      //  return $VehiculosListados;
         return view('vehiculos.detalles.detalle_vehiculo',compact('existe','VehiculosListados','asignacion_actual'));
    }

}
