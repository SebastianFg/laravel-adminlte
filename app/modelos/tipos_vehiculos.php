<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class tipos_vehiculos extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_tipo_vehiculo';
    protected $softDelete = true;

    public function scopeTipoVehiculo($query,$identificacion){

    	if (trim($identificacion) != "") {
    		return $query->where('nombre_tipo_vehiculo','ilike','%'.$identificacion.'%')
    					->get();

    	}
    }
}
