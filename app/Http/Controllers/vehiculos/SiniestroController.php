<?php

namespace App\Http\Controllers\vehiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
/*modelos*/
use App\Modelos\siniestro;
use App\Modelos\asignacion_vehiculo;
use App\Modelos\pdf_siniestro;


//paginador
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class SiniestroController extends Controller
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
//siniestros
    //index siniestro
    public function indexSiniestros(Request $Request){
        if (Auth::User()->primer_logeo == null) {
            return redirect('admin/primerIngreso');
        }

        if ($Request->vehiculoBuscado == null) {
            
        	$siniestros = siniestro::join('vehiculos','vehiculos.id_vehiculo','=','siniestros.id_vehiculo')
        							->join('dependencias','dependencias.id_dependencia','=','siniestros.id_dependencia')
                                    ->get();
        }else{
            $siniestros = siniestro::join('vehiculos','vehiculos.id_vehiculo','=','siniestros.id_vehiculo')
                                    ->join('dependencias','dependencias.id_dependencia','=','siniestros.id_dependencia')
                                    ->where('vehiculos.numero_de_identificacion','ilike',$Request->vehiculoBuscado)
                                    ->orwhere('vehiculos.dominio','ilike',$Request->vehiculoBuscado)
                                    ->get();
        }
    	$siniestros = $this->paginar($siniestros);
        return view('vehiculos/siniestros/siniestros_vehiculos',compact('siniestros'));
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

        $afectadoSiniestro = asignacion_vehiculo::where('id_vehiculo','=',$dato->id_vehiculo)->get();
       // $afectadoSiniestro = \DB::select('select destino from view_total_afectados where id_vehiculo ='. $dato->id_vehiculo);
       //dd ($afectadoSiniestro[0]->id_dependencia);
        //siniestro

        if ($accion == 2) {
            $siniestroNuevo =siniestro::findOrFail($dato->id_siniestro);
        }elseif($accion == 1){
            $siniestroNuevo = new siniestro;
        }
        //return $siniestroNuevo;
        $siniestroNuevo->id_vehiculo = $dato->id_vehiculo;
        $siniestroNuevo->id_dependencia = $afectadoSiniestro[0]->id_dependencia;
        $siniestroNuevo->observaciones_siniestro = $dato->observaciones_siniestro;
        $siniestroNuevo->lugar_siniestro = $dato->lugar_siniestro;
        $siniestroNuevo->fecha_siniestro = $dato->fecha_siniestro;
        $siniestroNuevo->fecha_presentacion = $dato->fecha_presentacion;
        $siniestroNuevo->lesiones_siniestro = $dato->id_lesionados;
        $siniestroNuevo->descripcion_siniestro = $dato->descripcion_siniestro;
        $siniestroNuevo->id_usuario = $dato->id_usuario;


        if ($accion == 2) {
        	if ($siniestroNuevo->update()) {
				if($dato->hasFile('pdf_siniestro')){

                $file = $dato->file('pdf_siniestro');
                $nombre_archivo_nuevo = time().$file->getClientOriginalName();
                $file->move(public_path().'/pdf/',$nombre_archivo_nuevo);
                
                $pdfSiniestro = new pdf_siniestro;
                $pdfSiniestro->nombre_pdf_siniestro = $nombre_archivo_nuevo;
                $pdfSiniestro->id_siniestro = $siniestroNuevo->id_siniestro ;
                $pdfSiniestro->save();
	            }
	        }
            return $this->getMensaje($mensaje,'indexSiniestros',true);
        }elseif($accion == 1){
        	
        	if ($siniestroNuevo->save()) {
        		if($dato->hasFile('pdf_siniestro')){

                $file = $dato->file('pdf_siniestro');
                $nombre_archivo_nuevo = time().$file->getClientOriginalName();
                $file->move(public_path().'/pdf/',$nombre_archivo_nuevo);
                
                $pdfSiniestro = new pdf_siniestro;
                $pdfSiniestro->nombre_pdf_siniestro = $nombre_archivo_nuevo;
                $pdfSiniestro->id_siniestro = $siniestroNuevo->id_siniestro ;
                $pdfSiniestro->save();
	            }
	        }
        	return $this->getMensaje($mensaje,'indexSiniestros',true);
        }
    }

    //alta siniestro
    public function altaSiniestro(Request $Request){
    	//return $Request;
    
        return $this->Siniestro($Request,'Agregado con exito',1);

    }
    //edicion de un siniestro
    public function editarSiniestro(Request $Request){

        return $this->Siniestro($Request,'Actualizado con exito',2);

    }

    public function getAllSiniestros(){
        
        $total_siniestros = \DB::Select("select vehiculos.numero_de_identificacion,vehiculos.id_vehiculo,afectado_siniestro,lugar_siniestro,
                                        siniestros.fecha_siniestro,siniestros.id_siniestro,lesiones_siniestro,siniestros.descripcion_siniestro,
                                        siniestros.fecha_presentacion,siniestros.observaciones_siniestro 
                                        from siniestros
                                        inner join vehiculos on vehiculos.id_vehiculo = siniestros.id_vehiculo
                                        where vehiculos.baja != 2
                                        order by siniestros.id_siniestro desc");
        $json_data=array(
          
            "recordsTotal" =>  intval(count($total_siniestros)),
            "recordsFiltered" => intval(count($total_siniestros)),
            "data" => $total_siniestros

        );
        return response()->json($json_data);
    }
    //modal que muestra todos los pdfs cargados
    public function getAllPdfsSiniestro(Request $Request){
        
        if (isset($Request)) {
            $historial_pdf  = \DB::select("select nombre_pdf_siniestro,to_char(created_at,'DD/MM/YYYY') as fecha from pdf_siniestros where id_siniestro ='".$Request->id_siniestro."'order by id_pdf_siniestro desc");
        }else{
            $historial_pdf = 'No posee datos';
        }
    
        return view('vehiculos/siniestros/modal_pdf_siniestro',compact('historial_pdf'));
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

    public function descargaPdfSiniestro($nombre){

        if(!$this->downloadFile(public_path()."/pdf/".$nombre)){
            return redirect()->back();
        }
    }

}
