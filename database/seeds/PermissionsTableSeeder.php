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
        Permission::create(['name' => 'vehiculos.crear']);
        Permission::create(['name' => 'vehiculos.editar']);
        Permission::create(['name' => 'vehiculos.eliminar']);
        Permission::create(['name' => 'vehiculos.informacion']);
        Permission::create(['name' => 'vehiculos.asignarNuevo']);
        Permission::create(['name' => 'vehiculos.asignarEditar']);
        Permission::create(['name' => 'vehiculos.asignarEliminar']);
        Permission::create(['name' => 'vehiculos.altaSiniestro']);
        Permission::create(['name' => 'vehiculos.editarSiniestro']);
        Permission::create(['name' => 'vehiculos.eliminarSiniestro']);
        Permission::create(['name' => 'usuarios.listaUsuarios']);
        Permission::create(['name' => 'usuarios.asignarRol']);
        Permission::create(['name' => 'usuarios.eliminarUsuario']);
        Permission::create(['name' => 'dependencias.eliminarDepencencia']);
        Permission::create(['name' => 'estados.altaEstado']);


     	$admin = Role::create(['name' => 'Admin']);

        $admin->givePermissionTo([
            'vehiculos.index',
            'vehiculos.crear',
            'vehiculos.editar',
            'vehiculos.eliminar',
            'vehiculos.informacion',
            'vehiculos.asignarNuevo',
            'vehiculos.asignarEditar',
            'vehiculos.asignarEliminar',
            'vehiculos.altaSiniestro',
            'vehiculos.editarSiniestro',
            'vehiculos.eliminarSiniestro',
            'usuarios.listaUsuarios',
            'usuarios.asignarRol',
            'usuarios.eliminarUsuario',
            'dependencias.eliminarDepencencia',
            'estados.altaEstado',
        ]);

       	$guest = Role::create(['name' => 'Cargar Vehiculos']);

        $guest->givePermissionTo([
            'vehiculos.index',
            'vehiculos.crear',
            'vehiculos.editar',
            'vehiculos.eliminar',
            'vehiculos.informacion',
            'vehiculos.asignarNuevo',
            'vehiculos.asignarEditar',
            'vehiculos.asignarEliminar',
            'vehiculos.altaSiniestro',
            'vehiculos.editarSiniestro',
            'vehiculos.eliminarSiniestro',
            'estados.altaEstado'
        ]);

/*        $user = User::find(1); //Italo Morales
        $user->assignRole('Admin');*/
    }
}
