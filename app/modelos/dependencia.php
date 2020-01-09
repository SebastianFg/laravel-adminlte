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
                            ->join('municipios','municipios.id_municipio','=','dep.id_municipio')
    						->select('dependencias.nombre_dependencia as padre','dep.nombre_dependencia as hijo','dep.id_dependencia as id_hijo','dependencias.id_dependencia as id_padre','dep.nivel_dependencia as nivel','dependencias.deleted_at','municipios.*')
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
