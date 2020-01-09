<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class elementos extends Model
{

    protected $table= "elementos";
    protected $fillable= ['descripcion', 'modelo', 'marca','fecha','serial'];

    // public function scopeIdentificacion($query,$identificacion){
        
    // 	if (trim($identificacion) != "") {
    // 		return $query->where('descripcion','ilike','%'.$identificacion.'%')
    // 					->orWhere('modelo','ilike','%'.$identificacion.'%')
    // 					->orWhere('marca','ilike','%'.$identificacion.'%')
    // 					->orWhere('serial','ilike','%'.$identificacion.'%')
    // 					->orWhere('fecha','ilike','%'.$identificacion.'%')
    //                     ->get();

                    
    //                 }
    //             }


}

