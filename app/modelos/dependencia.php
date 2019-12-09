<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;





class dependencia extends Model
{
    protected $table = 'dependencias';
    protected $primaryKey = 'id_dependencia';
    protected $softDelete = true;
    use SoftDeletes;

    public function scopeDependecia($query,$identificacion){
    	//dd($identificacion);
    	if (trim($identificacion) != "") {
    		return $query = dependencia::orderBy('dep.id_dependencia','desc')
    						->join('dependencias as dep','dep.id_padre_dependencia','=','dependencias.id_dependencia')
    						->select('dependencias.nombre_dependencia as padre','dep.nombre_dependencia as hijo','dep.deleted_at')
    						->orwhere('dep.nombre_dependencia','ilike','%'.$identificacion.'%')
    						->orWhere('dependencias.nombre_dependencia','ilike','%'.$identificacion.'%')
    						->orWhere('dep.nivel_dependencia','ilike','%'.$identificacion.'%')
                            ->whereNull('dep.deleted_at')
            /*                ->where('dep.deleted_at','!=',null)
                            ->where('dependencias.deleted_at','!=',null)*/
    						->get();


    	}
    }


}
