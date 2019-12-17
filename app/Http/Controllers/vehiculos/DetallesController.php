<?php

namespace App\Http\Controllers\vehiculos;

//laravel
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
//Modelos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Modelos\tipos_vehiculos;
use App\Modelos\vehiculo;
use App\Modelos\pdf_Estado;
use App\Modelos\imagen_vehiculo;
use App\Modelos\estado_vehiculo;
use App\Modelos\asignacion_vehiculo;
use App\Modelos\historial_asignacion;
use App\Modelos\siniestro;
use App\User;
//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

//pdf
use Barryvdh\DomPDF\Facade as PDF;

class DetallesController extends Controller
{
    public function __construct()
    {
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
        $datos = new LengthAwarePaginator(
            $collection->forPage(Paginator::resolveCurrentPage() , $por_pagina),
            $collection->count(), $por_pagina,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
        return $datos;
	}
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////// DETALLES //////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    protected function HistorialVehiculo($id){
        $historial = historial_asignacion::join('dependencias','dependencias.id_dependencia','=','historial_asignacion.id_dependencia')
                                            ->where('id_vehiculo','=',$id)
                                            ->orderBy('fecha','desc')
                                            ->get();
        $historial = $this->paginar($historial);
        return $historial;
    }
    protected function AsignacionActual($id){
        $asignacion_actual = asignacion_vehiculo::join('dependencias','dependencias.id_dependencia','=','detalle_asignacion_vehiculos.id_dependencia')
                                                ->join('users','detalle_asignacion_vehiculos.id_responsable','=','users.id')
                                                ->where('id_vehiculo','=',$id)->get();
        return $asignacion_actual;
    }

    protected function Siniestros($id){
        $siniestros = siniestro::join('vehiculos','vehiculos.id_vehiculo','=','siniestros.id_vehiculo')
                                ->join('dependencias','dependencias.id_dependencia','=','siniestros.id_dependencia')
                                ->where('vehiculos.id_vehiculo','=',$id)->get();
        $siniestros = $this->paginar($siniestros);
        return $siniestros;
    }

    public function index(Request $Request,$id = null){
        if (Auth::User()->primer_logeo == null) {
            return redirect('admin/primerIngreso');
        }

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }


        if ($id == null && $Request->vehiculoBuscado == null) {
        	$existe = 0;
        }elseif($id != null && $Request->vehiculoBuscado == null){

        	$existe = 1;
            $VehiculosListados = \DB::select('select * from vehiculos where id_vehiculo = '.$id);
        	$siniestros = $this->Siniestros($id);
            $historial = $this->HistorialVehiculo($id);
            $asignacion_actual = $this->AsignacionActual($id);
            $imagenes_vehiculo = imagen_vehiculo::where('id_vehiculo','=',$id)->select('nombre_imagen')->get();

        }elseif( $Request->vehiculoBuscado != null && $id == null){

            $vehiculo = \DB::select("select id_vehiculo from vehiculos where numero_de_identificacion = '".$Request->vehiculoBuscado."' or dominio = '".$Request->vehiculoBuscado."'");

            if (count($vehiculo)>0) {
                $existe = 1;
        	  // return $vehiculo;
                $historial = $this->HistorialVehiculo($vehiculo[0]->id_vehiculo);
                $asignacion_actual = $this->AsignacionActual($vehiculo[0]->id_vehiculo);
                //return $asignacion_actual;
                $siniestros = $this->Siniestros($vehiculo[0]->id_vehiculo);
                $imagenes_vehiculo = imagen_vehiculo::where('id_vehiculo','=',$vehiculo[0]->id_vehiculo)->select('nombre_imagen')->get();
                $VehiculosListados = \DB::select('select * from vehiculos where id_vehiculo = '.$vehiculo[0]->id_vehiculo);
            }else{
                $existe = 0;
            }
        }

        return view('vehiculos.detalles.detalle_vehiculo',compact('existe','VehiculosListados','asignacion_actual','historial','siniestros','imagenes_vehiculo'));
    }

    public function exportarPdfHistorial($id){

        $historialCompletoAsignacion = historial_asignacion::join('dependencias','dependencias.id_dependencia','=','historial_asignacion.id_dependencia')
                                                            ->join('vehiculos','vehiculos.id_vehiculo','=','historial_asignacion.id_vehiculo')
                                                            ->join('users','users.id','=','historial_asignacion.id_responsable')
                                                            ->select('vehiculos.dominio','vehiculos.numero_de_inventario','vehiculos.numero_de_identificacion','dependencias.nombre_dependencia','historial_asignacion.fecha','users.nombre')
                                                            ->where('historial_asignacion.id_vehiculo','=',$id)->get();

        $pdf = PDF::loadView('vehiculos.detalles.pdf_historial_vehiculo',compact('historialCompletoAsignacion'));

        return $pdf->download($historialCompletoAsignacion[0]->dominio.'.pdf');
    }
}
