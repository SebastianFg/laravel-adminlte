<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class estado_vehiculo_deposito_judicial extends Model
{
	protected $table = 'estado_vehiculos_deposito_judicial';
	protected $primaryKey = 'id_estado_vehiculo_deposito_judicial';

    public function scopeBuscarFueraDeServicioDP($query,$identificacion){

    	if (trim($identificacion) != "") {
    		return \DB::select("select * 
	                                FROM vehiculos_deposito_judicial
	                                    JOIN( SELECT max(evdp.id_estado_vehiculo_deposito_judicial) AS maxestado,
	                                            evdp.id_vehiculo_deposito_judicial
	                                        FROM estado_vehiculos_deposito_judicial evdp
	                                        WHERE evdp.tipo_estado_vehiculo_deposito_judicial = 1
	                                        GROUP BY evdp.id_vehiculo_deposito_judicial) r ON r.id_vehiculo_deposito_judicial = vehiculos_deposito_judicial.id_vehiculo_deposito_judicial
	                                JOIN estado_vehiculos_deposito_judicial ON r.maxestado = estado_vehiculos_deposito_judicial.id_estado_vehiculo_deposito_judicial
	                                WHERE vehiculos_deposito_judicial.baja_deposito_judicial = 1 and (numero_de_carpeta_deposito_judicial ='%".$identificacion."%' or numero_de_referencia_aleatorio_deposito_judicial ilike'%".$identificacion."%' or numero_de_identificacion_deposito_judicial ilike'%".$identificacion."%')");

    	}
    }
    public function scopeBuscarBajaDefinitiva($query,$identificacion){

    	if (trim($identificacion) != "") {
    		return $query->join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','estado_vehiculos_deposito_judicial.id_vehiculo_deposito_judicial')
	                        ->where('vehiculos_deposito_judicial.baja_deposito_judicial','=',2)
	                        ->where('estado_vehiculos_deposito_judicial.tipo_estado_vehiculo_deposito_judicial','=',2)
	                        ->where('vehiculos_deposito_judicial.numero_de_carpeta_deposito_judicial','ilike',$identificacion)
	                        ->select('vehiculos_deposito_judicial.*','estado_vehiculos_deposito_judicial.*')
	                        ->orderBy('estado_vehiculos_deposito_judicial.id_estado_vehiculo','desc')
	                        ->get();
    	}
    }

    public function scopeBuscarHistorialCompleto($query,$identificacion){

    	if (trim($identificacion) != "") {
    		return $query->join('vehiculos_deposito_judicial','vehiculos_deposito_judicial.id_vehiculo_deposito_judicial','=','estado_vehiculos_deposito_judicial.id_vehiculo_deposito_judicial')
	                        ->where('vehiculos_deposito_judicial.numero_de_carpeta_deposito_judicial','ilike',$identificacion)
                            ->orwhere('vehiculos_deposito_judicial.numero_de_referencia_aleatorio_deposito_judicial','ilike',$identificacion)
	                        ->select('vehiculos_deposito_judicial.*','estado_vehiculos_deposito_judicial.*')
	                        ->orderBy('estado_vehiculos_deposito_judicial.id_estado_vehiculo_deposito_judicial','desc')
	                        ->get();
    	}
    }
}
