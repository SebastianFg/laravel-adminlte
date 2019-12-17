<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
  	use SoftDeletes;

	protected $table = 'roles';




	public function users(){
	    return $this
	        ->belongsToMany('App\User');
    }


}
