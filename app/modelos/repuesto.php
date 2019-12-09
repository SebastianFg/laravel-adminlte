<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class repuesto extends Model
{
    protected $table = 'detalle_asignacion_repuestos';
    protected $primaryKey = 'id_detalle_repuesto';
}
