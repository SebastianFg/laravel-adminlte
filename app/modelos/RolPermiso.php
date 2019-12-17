<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class RolPermiso extends Model
{
    public static function scopebuscarPermisoRol($query,$identificacion){
        dd($identificacion);

        if (trim($identificacion) != "") {
            return $query->where('name','ilike','%'.$identificacion.'%')
                        ->get();

        }
    }
}
