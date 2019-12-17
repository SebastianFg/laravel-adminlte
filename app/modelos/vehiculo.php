<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use App\Modelos\asignacion_vehiculo;

class vehiculo extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_vehiculo';
    protected $softDelete = true;

    public function scopeIdentificacion($query,$identificacion){
        
    	if (trim($identificacion) != "") {
    		return $query->where('numero_de_identificacion','ilike','%'.$identificacion.'%')
    					->orWhere('dominio','ilike','%'.$identificacion.'%')
    					->orWhere('marca','ilike','%'.$identificacion.'%')
    					->orWhere('modelo','ilike','%'.$identificacion.'%')
    					->orWhere('numero_de_inventario','ilike','%'.$identificacion.'%')
    					/*->orWhere('tipo','ilike',$identificacion)*/
                        ->orWhere('clase_de_unidad','ilike','%'.$identificacion.'%')
                        ->orWhere('anio_de_produccion','ilike','%'.$identificacion.'%')
                        ->join('tipos_vehiculos','tipos_vehiculos.id_tipo_vehiculo','=','vehiculos.tipo')
                        ->select('vehiculos.*','tipos_vehiculos.*')
    					->get();

    	}
    }
}
