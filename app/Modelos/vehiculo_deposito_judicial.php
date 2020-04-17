<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class vehiculo_deposito_judicial extends Model
{
	use SoftDeletes;
    protected $primaryKey = 'id_vehiculo_deposito_judicial';
    protected $table = 'vehiculos_deposito_judicial';
}
