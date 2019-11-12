<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class dependencia extends Model
{
    protected $table = 'dependencias';
    protected $softDelete = true;

    public function scopeDependecia($query,$identificacion){
    	//dd($identificacion);
    	if (trim($identificacion) != "") {
    		return $query = dependencia::orderBy('dep.id_dependencia')
    						->join('dependencias as dep','dep.id_padre_dependencia','=','dependencias.id_dependencia')
    						->select('dependencias.nombre_dependencia as padre','dep.nombre_dependencia as hijo')
    						->where('dep.nombre_dependencia','ilike','%'.$identificacion.'%')
    						->orWhere('dependencias.nombre_dependencia','ilike','%'.$identificacion.'%')
    						->orWhere('dep.nivel_dependencia','ilike','%'.$identificacion.'%')
    						->get();


    	}
    }
}
