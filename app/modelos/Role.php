<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;
use User;
use Illuminate\Database\Eloquent\softDeletes;

class Role extends Model
{
  	use SoftDeletes;

	protected $table = 'roles'




	public function users(){
	    return $this
	        ->belongsToMany('App\User');
    }


}
