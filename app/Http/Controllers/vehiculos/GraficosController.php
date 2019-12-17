<?php

namespace App\Http\Controllers\vehiculos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\modelos\tipos_vehiculos;
use App\modelos\vehiculo;
use App\modelos\pdf_Estado;
use App\modelos\imagen_vehiculo;
use App\modelos\estado_vehiculo;
use App\User;

class GraficosController extends Controller
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
        $datos= new LengthAwarePaginator(
            $collection->forPage(Paginator::resolveCurrentPage() , $por_pagina),
            $collection->count(), $por_pagina,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
        return $datos;
	}
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////// Graficos ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index(Request $Request){
        if (Auth::User()->primer_logeo == null) {
            return redirect('admin/primerIngreso');
        }

        if (strpos(Auth::User()->roles,'Suspendido')) {
            Auth::logout();
            alert()->error('Su usuario se encuentra suspendido');
             return redirect('/login');
        }

        $total_vehiculos_disponibles = \DB::select('SELECT tipos_vehiculos.nombre_tipo_vehiculo,count(vehiculos.*) AS total_vehiculos
													FROM tipos_vehiculos
													JOIN vehiculos ON tipos_vehiculos.id_tipo_vehiculo = vehiculos.tipo AND vehiculos.baja = 0
													GROUP BY tipos_vehiculos.id_tipo_vehiculo');

        $total_vehiculos_reparacion =  \DB::select('select count(*) as "Total",rbaja.totalbaja,r.totalreparacion
                                                from vehiculos,
                                                (select count(*) as "totalbaja" from vehiculos where vehiculos.baja = 2) as rbaja,
                                                (select count(*) as "totalreparacion" from vehiculos where vehiculos.baja = 1) as r
                                                group by rbaja.totalbaja,r.totalreparacion');
        $total_siniestros = \DB::select('select count(*) as totalsiniestro,extract(year from fecha_siniestro) as anio
                                        from siniestros
                                        group by extract(year from fecha_siniestro)
                                        order by anio asc');

         return view('vehiculos.graficos.lista_reportes',compact('total_vehiculos_disponibles','total_vehiculos_reparacion','total_siniestros'));
    }
    public function reportesListadoFiltro(Request $Request){

        $total_siniestros = \DB::select('select count(*) as totalsiniestro,extract(month from fecha_siniestro) as mes,
                                        extract(year from fecha_siniestro) as anio--,extract(month from fecha_siniestro) as mes
                                        from siniestros
                                        where extract(year from fecha_siniestro) = '.$Request->anio.'
                                        group by extract(year from fecha_siniestro),extract(month from fecha_siniestro)
                                        order by anio asc');
        
        $mes = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
       	for ($i=0; $i <count($total_siniestros) ; $i++)
           $total_siniestros[$i]->mes = $mes[intval($total_siniestros[$i]->mes)-1];

        return view('vehiculos.graficos.lista_reporte_grafico_barras',compact('total_siniestros','mes'));
    }

}
