<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		Permission::create(['name' => 'vehiculos.index']);
        Permission::create(['name' => 'vehiculos.edit']);
        Permission::create(['name' => 'vehiculos.show']);
        Permission::create(['name' => 'vehiculos.create']);
        Permission::create(['name' => 'vehiculos.destroy']);
        Permission::create(['name' => 'usuarios.listaUsuarios']);
        Permission::create(['name' => 'usuarios.asignarRol']);
        Permission::create(['name' => 'usuarios.eliminarUsuario']);

     	$admin = Role::create(['name' => 'Admin']);

        $admin->givePermissionTo([
            'vehiculos.index',
            'vehiculos.edit',
            'vehiculos.show',
            'vehiculos.create',
            'vehiculos.destroy',
            'usuarios.listaUsuarios',
            'usuarios.asignarRol',
            'usuarios.eliminarUsuario'
        ]);

       	$guest = Role::create(['name' => 'Guest']);

        $guest->givePermissionTo([
            'vehiculos.index',
            'vehiculos.show'
        ]);

/*        $user = User::find(1); //Italo Morales
        $user->assignRole('Admin');*/
    }
}
