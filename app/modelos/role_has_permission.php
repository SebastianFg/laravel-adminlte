<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use DB;

class role_has_permission extends Model
{
    protected $table = 'role_has_permissions';

    public function getAllPermisos($id){
    	$permisos = \DB::select('select * from role_has_permissions where permission_id ='.$id);
    	return $this->permisos;
    }
}
