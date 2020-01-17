<?php

namespace App\Http\Controllers\Municipios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
//modelos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Modelos\municipio;
use App\User;

//librerias
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Support\Facades\Auth;
//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class MunicipioController extends Controller
{
	public function __construct(){
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
        $datos= new LengthAwarePaginator(
            $collection->forPage(Paginator::resolveCurrentPage() , $por_pagina),
            $collection->count(), $por_pagina,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
        return $datos;
	}
    protected function validarMunicipio($dato){

        $Validar = \Validator::make($dato->all(), [
            
            'nombre_municipio' => 'required|unique:municipios',
            'nombre_departamento' => 'required',
            'poblacion' => 'required',
            'zona' => 'required|in:norte,sur,este,oeste,centro',
            'mujeres' => 'required|integer',
            'varones' => 'required|integer',
            'unidad_regional' => 'required|string|in:I,II,III,IV,V,VI,VII,VIII,IX,X,XI,XII,XIII'

        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
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

        if ($Request->nombreMunicipio != null) {
            $municipios = Municipio::Identificacion($Request->nombreMunicipio);
        }else{
    		$municipios = Municipio::orderBy('id_municipio','desc')->get();
        }
        $municipios = $this->paginar($municipios);


		return view('municipios.municipio',compact('municipios'));
	}



	public function crearMunicipio(Request $Request){

        $Validar = \Validator::make($Request->all(), [
            
            'nombre_municipio' => 'required|unique:municipios',
            'nombre_departamento' => 'required',
            'poblacion' => 'required',
            'zona' => 'required|in:norte,sur,este,oeste,centro',
            'mujeres' => 'required|integer',
            'varones' => 'required|integer',
            'unidad_regional' => 'required|string|in:I,II,III,IV,V,VI,VII,VIII,IX,X,XI,XII,XIII'

        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }

        $nuevaLocalidad = new Municipio;

        $nuevaLocalidad->nombre_municipio = $Request->nombre_municipio;
        $nuevaLocalidad->nombre_departamento = $Request->nombre_departamento;
        $nuevaLocalidad->poblacion = $Request->poblacion;
        $nuevaLocalidad->varones = $Request->varones;
        $nuevaLocalidad->mujeres = $Request->mujeres;
        $nuevaLocalidad->zona = $Request->zona;
        $nuevaLocalidad->ur = $Request->unidad_regional;

        if($nuevaLocalidad->save()){
            return $this->getMensaje('Municipio guardada con exito','indexMunicipios',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','indexMunicipios',false);
        } 
	}

    public function editarMunicipio(Request $Request){

        $Validar = \Validator::make($Request->all(), [
            
            'nombre_municipio' => ['required',
                              Rule::unique('municipios')->ignore($Request->nombre_municipio,'nombre_municipio')],
            'nombre_departamento' => 'required',
            'poblacion' => 'required',
            'zona' => 'required|in:norte,sur,este,oeste,centro',
            'mujeres' => 'required|integer',
            'varones' => 'required|integer',
            'unidad_regional' => 'required|string|in:I,II,III,IV,V,VI,VII,VIII,IX,X,XI,XII,XIII'

        ]);
        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }

        $nuevaLocalidad = Municipio::FindOrFail($Request->id_municipio);

        $nuevaLocalidad->nombre_municipio = $Request->nombre_municipio;
        $nuevaLocalidad->nombre_departamento = $Request->nombre_departamento;
        $nuevaLocalidad->poblacion = $Request->poblacion;
        $nuevaLocalidad->varones = $Request->varones;
        $nuevaLocalidad->mujeres = $Request->mujeres;
        $nuevaLocalidad->zona = $Request->zona;
        $nuevaLocalidad->ur = $Request->unidad_regional;

        if($nuevaLocalidad->save()){
            return $this->getMensaje('Localdiad guardada con exito','indexMunicipios',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','indexMunicipios',false);
        }
    }

	public function eliminarMunicipio(Request $Request){

		$eliminarMunicipio = Municipio::FindOrFail($Request->id_municipio);

        if($eliminarMunicipio->delete()){
            return $this->getMensaje('Municipio eliminado con exito','indexMunicipios',true);           
        }else{
            return $this->getMensaje('Verifique y Intente nuevamente','indexMunicipios',false);
        }

	}

    public function getAllMunicipios(Request $Request){
        $municipios = Municipio::where('nombre_municipio','ilike','%'.$Request->termino.'%')
                                ->orwhere('nombre_departamento','ilike','%'.$Request->termino.'%')
                                ->get();

        return response()->json($municipios);
    }
}
