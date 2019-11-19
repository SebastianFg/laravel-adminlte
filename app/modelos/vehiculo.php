<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
//use App\Modelos\asignacion_vehiculo;

class vehiculo extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_vehiculo';
    protected $softDelete = true;

    public function scopeIdentificacion($query,$identificacion){

    	if (trim($identificacion) != "") {
    		return $query->where('numero_de_identificacion','like','%'.$identificacion.'%')
    					->orWhere('dominio','like','%'.$identificacion.'%')
    					->orWhere('marca','like','%'.$identificacion.'%')
    					->orWhere('modelo','like','%'.$identificacion.'%')
    					->orWhere('numero_de_inventario','like','%'.$identificacion.'%')
    					->orWhere('tipo','like','%'.$identificacion.'%')
                        ->orWhere('clase_de_unidad','like','%'.$identificacion.'%')
                        ->join('tipos_vehiculos','tipos_vehiculos.id_tipo_vehiculo','=','vehiculos.tipo')
                        ->select('vehiculos.*','tipos_vehiculos.*')
    					->get();

    	}
    }



}
