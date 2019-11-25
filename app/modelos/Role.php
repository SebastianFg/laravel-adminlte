<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;
use User;
use Illuminate\Database\Eloquent\softDeletes;

class Role extends Model
{
  	use SoftDeletes;

	protected $table = 'roles'


    public static function scopebuscaRole($query,$identificacion){
        //dd($identificacion);

        if (trim($identificacion) != "") {
            return $query->where('name','ilike','%'.$identificacion.'%')
                        ->get();

        }
    }


}
