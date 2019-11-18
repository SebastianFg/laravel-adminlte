<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class asignacion_vehiculo extends Model
{
	protected $primaryKey = 'id_detalle';
	protected $table = 'detalle_asignacion_vehiculos';

    public function Dependencias()
    {
        return $this->belongsTo('App\modelos\dependencia');
    }
}
