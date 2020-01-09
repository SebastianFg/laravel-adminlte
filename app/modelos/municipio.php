<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class municipio extends Model
{
    protected $primaryKey = 'id_municipio';
    protected $softDelete = true;
	protected $table = 'municipios';


    public function scopeIdentificacion($query,$identificacion){
        
    	if (trim($identificacion) != "") {
    		return $query->where('nombre_municipio','ilike','%'.$identificacion.'%')
    					->orderBy('id_municipio','desc')
    					->get();
    	}
    }


}
