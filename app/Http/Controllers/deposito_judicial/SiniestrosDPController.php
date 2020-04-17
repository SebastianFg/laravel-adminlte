<?php

namespace App\Http\Controllers\deposito_judicial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

//modelos
use App\Modelos\vehiculos_deposito_judicial;
use App\Modelos\siniestro_deposito_judicial;
use App\Modelos\asignacion_vehiculo_deposito_judicial;
use App\Modelos\pdf_siniestro_deposito_judicial;

class SiniestrosDPController extends Controller
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

    public function indexSiniestrosDP(Request $Request){

        if (Auth::User()->primer_logeo == null) {
            return redirect('/primerIngreso');
        }
        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }


      
        if ($Request->vehiculoBuscado == null) {
            $siniestros = siniestro_deposito_judicial::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','siniestros_deposito_judicial.id_vehiculo_deposito_judicial')
                                    ->join('dependencias','dependencias.id_dependencia','=','siniestros_deposito_judicial.id_dependencia')
                                    ->leftJoin('pdf_siniestros_deposito_judicial','siniestros_deposito_judicial.id_siniestro_deposito_judicial','=','pdf_siniestros_deposito_judicial.id_siniestro_deposito_judicial')
                                    ->select('vehiculos_deposito_judicial.*','dependencias.*','pdf_siniestros_deposito_judicial.id_pdf_siniestro_deposito_judicial','pdf_siniestros_deposito_judicial.nombre_pdf_siniestro_deposito_judicial','siniestros_deposito_judicial.*')
                                    ->orderBy('siniestros_deposito_judicial.id_siniestro_deposito_judicial','desc')
                                    ->get();      
        }else{
            
            $siniestros = siniestro_deposito_judicial::join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','siniestros_deposito_judicial.id_vehiculo_deposito_judicial')
                                    ->join('dependencias','dependencias.id_dependencia','=','siniestros_deposito_judicial.id_dependencia')
                                    ->leftJoin('pdf_siniestros_deposito_judicial','siniestros_deposito_judicial.id_siniestro_deposito_judicial','=','pdf_siniestros_deposito_judicial.id_siniestro_deposito_judicial')

                                    ->select('vehiculos_deposito_judicial.*','dependencias.*','pdf_siniestros_deposito_judicial.id_pdf_siniestro_deposito_judicial','pdf_siniestros_deposito_judicial.nombre_pdf_siniestro_deposito_judicial','siniestros_deposito_judicial.*')

                                    ->where('vehiculos_deposito_judicial.numero_de_referencia_aleatorio_deposito_judicial','ilike',$Request->vehiculoBuscado)

                                    ->orwhere('vehiculos_deposito_judicial.dominio_deposito_judicial','ilike',$Request->vehiculoBuscado)
                                    ->orderBy('siniestros_deposito_judicial.id_siniestro_deposito_judicial','desc')
                                    ->get();  
        }

    	$siniestros = $this->paginar($siniestros);
        return view('deposito_judicial/siniestros/siniestros_vehiculos',compact('siniestros'));
    }
/*    public function getAllVehiculosDepositoJudicial(){
        
        $total_siniestros = \DB::Select("select vehiculos_deposito_judicial.numero_de_identificacion_deposito_judicial,vehiculos_deposito_judicial.id_vehiculo_deposito_judicial,afectado_siniestro_deposito_judicial,lugar_siniestro_deposito_judicial,
                                        siniestros_deposito_judicial.fecha_siniestro_deposito_judicial,siniestros_deposito_judicial.id_siniestro_deposito_judicial,lesiones_siniestro_deposito_judicial,siniestros_deposito_judicial.descripcion_siniestro_deposito_judicial,
                                        siniestros_deposito_judicial.fecha_presentacion_deposito_judicial,siniestros_deposito_judicial.observaciones_siniestro_deposito_judicial
                                        from siniestros_deposito_judicial
                                        inner join vehiculos_deposito_judicial on vehiculos_deposito_judicial.id_vehiculo_deposito_judicial = siniestros_deposito_judicial.id_vehiculo_deposito_judicial
                                        where vehiculos_deposito_judicial.baja_deposito_judicial != 2
                                        order by siniestros_deposito_judicial.id_siniestro_deposito_judicial desc");
        $json_data=array(
          
            "recordsTotal" =>  intval(count($total_siniestros)),
            "recordsFiltered" => intval(count($total_siniestros)),
            "data" => $total_siniestros

        );
        return response()->json($json_data);
    }*/

    public function getAllVehiculosDepositoJudicial (Request $Request){
        
        $vehiculos_disponibles = \DB::select("select * 
        									from vehiculos_deposito_judicial
                                            inner join detalle_asignacion_vehiculos_deposito_judicial on detalle_asignacion_vehiculos_deposito_judicial.id_vehiculo_deposito_judicial = vehiculos_deposito_judicial.id_vehiculo_deposito_judicial
                                            where vehiculos_deposito_judicial.dominio_deposito_judicial ilike '%".$Request->termino."%' or vehiculos_deposito_judicial.numero_de_referencia_aleatorio_deposito_judicial ilike '%".$Request->termino."%' 
                                            and vehiculos_deposito_judicial.baja_deposito_judicial != 2" );

        return response()->json($vehiculos_disponibles);

    }

    protected function Siniestro($dato,$mensaje,$accion = null){

        $Validar = \Validator::make($dato->all(), [
        
            'id_vehiculo' => 'required',
            'id_lesionados' => 'required',
            'fecha_siniestro' => 'required',
            'fecha_presentacion' => 'required',
            'lugar_siniestro' => 'required|max:255',
            'observaciones_siniestro' => 'required',
            'descripcion_siniestro' => 'required'

        ]);

        if ($Validar->fails()){
            alert()->error('Error','ERROR! Intente agregar nuevamente...');
            return  back()->withInput()->withErrors($Validar->errors());
        }
        //return $dato;
        $afectadoSiniestro = asignacion_vehiculo_deposito_judicial::where('id_vehiculo_deposito_judicial','=',$dato->id_vehiculo)->get();
        //return $afectadoSiniestro;
        if (count($afectadoSiniestro = asignacion_vehiculo_deposito_judicial::where('id_vehiculo_deposito_judicial','=',$dato->id_vehiculo)->get()) == 0) {
            //return count($afectadoSiniestro = asignacion_vehiculo::where('id_vehiculo','=',$dato->id_vehiculo)->get());  
            $vehiculoDadoDeBaja = vehiculos_deposito_judicial::onlyTrashed('id_vehiculo_deposito_judicial',$dato->id_vehiculo)->where('baja_deposito_judicial','=',2)->get();
           // return $vehiculoDadoDeBaja;
            if ($vehiculoDadoDeBaja[0]->baja == 2) {
                return $this->getMensaje('Vehiculo con baja definitiva, no se puede asignar siniestros','indexSiniestrosDP',false);
            }
        }

        if ($accion == 2) {
            $siniestroNuevo =siniestro_deposito_judicial::findOrFail($dato->id_siniestro);
        }elseif($accion == 1){
            $siniestroNuevo = new siniestro_deposito_judicial;
        }

        //return $afectadoSiniestro;
        $siniestroNuevo->id_vehiculo_deposito_judicial = $dato->id_vehiculo;
        $siniestroNuevo->id_dependencia = $afectadoSiniestro[0]->id_dependencia;
        $siniestroNuevo->observaciones_siniestro_deposito_judicial = $dato->observaciones_siniestro;
        $siniestroNuevo->lugar_siniestro_deposito_judicial = $dato->lugar_siniestro;
        $siniestroNuevo->fecha_siniestro_deposito_judicial = $dato->fecha_siniestro;
        $siniestroNuevo->fecha_presentacion_deposito_judicial = $dato->fecha_presentacion;
        $siniestroNuevo->lesiones_siniestro_deposito_judicial = $dato->id_lesionados;
        $siniestroNuevo->descripcion_siniestro_deposito_judicial = $dato->descripcion_siniestro;
        $siniestroNuevo->id_usuario = $dato->id_usuario;


        if ($accion == 2) {

            if ($siniestroNuevo->update()) {
                if($dato->hasFile('pdf_siniestro')){

                    $file = $dato->file('pdf_siniestro');
                    $nombre_archivo_nuevo = time().$file->getClientOriginalName();

                    Storage::disk("public")->put($nombre_archivo_nuevo, file_get_contents($file));
                    Storage::move("public/".$nombre_archivo_nuevo, "public/pdf/pdf_siniestros_deposito_judicial/".$nombre_archivo_nuevo);
                   // $file->move(public_path().'/pdf/pdf_siniestros/',$nombre_archivo_nuevo);
                    $pdf = pdf_siniestro_deposito_judicial::where('id_siniestro_deposito_judicial','=',$siniestroNuevo->id_siniestro_deposito_judicial)->count();

                    if ($pdf ==0) {
                        $pdfSiniestro = new pdf_siniestro_deposito_judicial;
                    }else{
                        $pdfSiniestro = pdf_siniestro_deposito_judicial::where('id_siniestro_deposito_judicial','=',$siniestroNuevo->id_siniestro_deposito_judicial)->get();
                    }
                    $pdfSiniestro[0]->nombre_pdf_siniestro_deposito_judicial = $nombre_archivo_nuevo;
                    $pdfSiniestro[0]->id_siniestro_deposito_judicial = $siniestroNuevo->id_siniestro ;
            
                    if ($pdf == 0) {
                        $pdfSiniestro[0]->save();
                    }else{
                       $pdfSiniestro[0]->update();
                    }
                    
                }
            }
            return $this->getMensaje($mensaje,'indexSiniestrosDP',true);
        }elseif($accion == 1){
            
            if ($siniestroNuevo->save()) {
                if($dato->hasFile('pdf_siniestro')){

                $file = $dato->file('pdf_siniestro');
                $nombre_archivo_nuevo = time().$file->getClientOriginalName();
                Storage::disk("public")->put($nombre_archivo_nuevo, file_get_contents($file));
                Storage::move("public/".$nombre_archivo_nuevo, "public/pdf/pdf_siniestros_deposito_judicial/".$nombre_archivo_nuevo);

                $pdfSiniestro = new pdf_siniestro_deposito_judicial;
                $pdfSiniestro->nombre_pdf_siniestro_deposito_judicial = $nombre_archivo_nuevo;
                $pdfSiniestro->id_siniestro_deposito_judicial = $siniestroNuevo->id_siniestro_deposito_judicial;
                $pdfSiniestro->save();
                }
            }
            return $this->getMensaje($mensaje,'indexSiniestrosDP',true);
        }
    }

    //alta siniestro
    public function altaSiniestroDP(Request $Request){
        return $this->Siniestro($Request,'Agregado con exito',1);

    }

    public function editarSiniestroDP(Request $Request){
        
        return $this->Siniestro($Request,'Actualizado con exito',2);

    }
}
