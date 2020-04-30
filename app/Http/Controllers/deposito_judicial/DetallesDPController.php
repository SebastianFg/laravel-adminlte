<?php

namespace App\Http\Controllers\deposito_judicial;


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
use App\Modelos\repuestosDP;
use App\Modelos\mandatario_dignatario;

use App\Modelos\vehiculo_deposito_judicial;
use App\Modelos\siniestro_deposito_judicial;
use App\Modelos\asignacion_vehiculo_deposito_judicial;
use App\Modelos\imagen_judicial_vehiculo;
use App\Modelos\historial_asignacion_deposito_judicial;


use App\User;
//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

//pdf
use Barryvdh\DomPDF\Facade as PDF;


class DetallesDPController extends Controller
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
        $historial = historial_asignacion_deposito_judicial::join('dependencias','dependencias.id_dependencia','=','historial_asignacion_deposito_judicial.id_dependencia')
                                            ->where('id_vehiculo_deposito_judicial','=',$id)
                                            ->orderBy('fecha_deposito_judicial','desc')
                                            ->get();
        $historial = $this->paginar($historial);
        return $historial;
    }


    protected function Repuestos($id){
        $historial = repuestosDP::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','detalle_asignacion_repuestos_deposito_judicial.id_vehiculo_deposito_judicial')
                            ->join('users','users.id','=','detalle_asignacion_repuestos_deposito_judicial.id_responsable')
                            ->where('vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=',$id)
                            ->orderBy('id_detalle_repuesto_deposito_judicial','desc')
                            ->get();                                         
        $historial = $this->paginar($historial);
        return $historial;
    }


    protected function AsignacionActual($id){
        $asignacion_actual = asignacion_vehiculo_deposito_judicial::join('dependencias','dependencias.id_dependencia','=','detalle_asignacion_vehiculos_deposito_judicial.id_dependencia')
                                                ->join('users','detalle_asignacion_vehiculos_deposito_judicial.id_responsable','=','users.id')
                                                ->where('id_vehiculo_deposito_judicial','=',$id)->get();
        return $asignacion_actual;
    }

    protected function Siniestros($id){
        $siniestros = siniestro_deposito_judicial::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','siniestros_deposito_judicial.id_vehiculo_deposito_judicial')
                                ->join('dependencias','dependencias.id_dependencia','=','siniestros_deposito_judicial.id_dependencia')
                                ->where('vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=',$id)
                              
                              
                                ->get();
        $siniestros = $this->paginar($siniestros);
        return $siniestros;
    }

    protected function Mandatario_Dignatario($id){
        $mandatario_dignatario = mandatario_dignatario::where('id_asignacion','=',$id)->get();
        $mandatario_dignatario = $this->paginar($mandatario_dignatario);
        return $mandatario_dignatario;
    }

    public function detalleVehiculoDP($id){

        if (Auth::User()->primer_logeo == null) {
            return redirect('/primerIngreso');
        }

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        if ($id == null) {
        	$existe = 0;
            $VehiculosListados = 0;
            $siniestros = 0;
            $repuestos = 0;
            $asignacion_actual = 0;
            $imagenes_vehiculo = 0;
            $historial = 0;
        }elseif($id != null){

        	$existe = 1;
            $VehiculosListados = \DB::select('select * from vehiculos_deposito_judicial as vdj
                                                        inner join juzgados on juzgados.id_juzgado = vdj.id_juzgado
                                                        left join marcas on marcas.id_marca = vdj.marca_deposito_judicial  
                                                        where vdj.id_vehiculo_deposito_judicial = '.$id);

        	$siniestros = $this->Siniestros($id);
            $repuestos = $this->Repuestos($id);
            $historial = $this->HistorialVehiculo($id);
            $asignacion_actual = $this->AsignacionActual($id);
            $imagenes_vehiculo = imagen_judicial_vehiculo::where('id_vehiculo_deposito_judicial','=',$id)
            												->select('id_vehiculo_deposito_judicial','nombre_imagen')
            												->get();

        }




        return view('deposito_judicial.detalles.detalle_vehiculo',compact('existe','VehiculosListados','asignacion_actual','historial','siniestros','imagenes_vehiculo','Mandatario_Dignatario','repuestos'));
    }

    public function exportarPdfHistorialDP($id){

        $historialCompletoAsignacion = historial_asignacion_deposito_judicial::join('dependencias','dependencias.id_dependencia','=','historial_asignacion_deposito_judicial.id_dependencia')
                                                            ->join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','historial_asignacion_deposito_judicial.id_vehiculo_deposito_judicial')
                                                            ->join('users','users.id','=','historial_asignacion_deposito_judicial.id_responsable_deposito_judicial')
                                                            ->select('vehiculos_deposito_judicial.dominio_deposito_judicial','vehiculos_deposito_judicial.numero_de_carpeta_deposito_judicial','dependencias.nombre_dependencia','historial_asignacion_deposito_judicial.*','users.nombre')
                                                            ->where('historial_asignacion_deposito_judicial.id_vehiculo_deposito_judicial','=',$id)

                                                            ->get();

        $pdf = PDF::loadView('deposito_judicial.detalles.pdf_historial_vehiculo',compact('historialCompletoAsignacion'));

        return $pdf->download($historialCompletoAsignacion[0]->numero_de_carpeta_deposito_judicial.'.pdf');
    }

    //tratamiento para descargar el pdf.
    protected function downloadFile($src){
        if(is_file($src)){
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $content_type = finfo_file($finfo, $src);
            finfo_close($finfo);
            $file_name = basename($src).PHP_EOL;
            $size = filesize($src);
            header("Content-Type: $content_type");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: $size");
            readfile($src);
            return true;
        } else{
            return false;
        }
    }

    public function exportarpdfexpofhistorial($expof){

        $descarga_asignacion_historial = historial_asignacion_deposito_judicial::where('expof_deposito_judicial','=',$expof)->select('pdf_nombre_deposito_judicial')->get();


        if(!$this->downloadFile(storage_path()."/app/public/pdf/pdf_expof/".$descarga_asignacion_historial[0]->pdf_nombre_deposito_judicial)){
            return redirect()->back();
        }
    }
}
