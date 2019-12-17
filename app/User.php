<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use modelos\Role;
use \DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'usuario', 'password','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
/*    public function users(){
        $lista = \DB::select('select roles.name,roles.id as rol_id,users.nombre,users.id as user_id
                            from roles
                            inner join model_has_roles as mhr on roles.id = mhr.role_id
                            inner join users on users.id = mhr.model_id
                            where users.id ='.$this->id);
        return $lista;
    }*/

    public static function scopebuscarUsuario($query,$identificacion){
        //dd($identificacion);

        if (trim($identificacion) != "") {
            return $query->where('nombre','ilike','%'.$identificacion.'%')
                        ->orWhere('usuario','ilike','%'.$identificacion.'%')
                        ->get();

        }
    }

    public function setPasswordAttribute($pass){
        $this->attributes['password'] = Hash::make($pass);
    }
}
