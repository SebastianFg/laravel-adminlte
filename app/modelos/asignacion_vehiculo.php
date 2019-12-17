<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

use App\Modelos\Vehiculo;

class asignacion_vehiculo extends Model
{
	protected $primaryKey = 'id_detalle';
	protected $table = 'detalle_asignacion_vehiculos';

    public function Dependencias()
    {
        return $this->belongsTo('App\Modelos\dependencia');
    }



}

