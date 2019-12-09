<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use DB;

class estado_vehiculo extends Model
{
    protected $primaryKey = 'id_estado_vehiculo';
    protected $table = 'estado_vehiculos';


    public function scopeBuscarFueraDeServicio($query,$identificacion){

    	if (trim($identificacion) != "") {
    		return \DB::select("select * from view_vehiculos_en_reparacion where numero_de_identificacion = '".$identificacion."'");

    	}
    }

    public function scopeBuscarBajaDefinitiva($query,$identificacion){

    	if (trim($identificacion) != "") {
    		return $query->join('vehiculos','vehiculos.id_vehiculo','=','estado_vehiculos.id_vehiculo')
	                        ->select('vehiculos.*','estado_vehiculos.*')
	                        ->orderBy('estado_vehiculos.id_estado_vehiculo','desc')
	                        ->where('vehiculos.baja','=',2)
	                        ->where('estado_vehiculos.tipo_estado_vehiculo','=',2)
	                        ->where('vehiculos.numero_de_identificacion','ilike',$identificacion)
	                        ->get();
    	}
    }

    public function scopeBuscarHistorialCompleto($query,$identificacion){

    	if (trim($identificacion) != "") {
    		return $query->join('vehiculos','vehiculos.id_vehiculo','=','estado_vehiculos.id_vehiculo')
	                        ->select('vehiculos.*','estado_vehiculos.*')
	                        ->orderBy('estado_vehiculos.id_estado_vehiculo','desc')
	                        ->where('vehiculos.numero_de_identificacion','ilike',$identificacion)
                            ->orwhere('vehiculos.dominio','ilike',$identificacion)
	                        ->get();
    	}
    }

}
