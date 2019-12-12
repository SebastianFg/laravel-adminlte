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
        //borramos la tabla y no funciona la mierda esta
        /*Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();
        app()['cache']->forget('spatie.permission.cache');*/
        // Clear cache
/*        app()[PermissionRegistrar::class]->forgetCachedPermissions();*/

		Permission::create(['name' => 'vehiculos.index']);
        Permission::create(['name' => 'vehiculos.crear']);
        Permission::create(['name' => 'vehiculos.editar']);
        Permission::create(['name' => 'vehiculos.eliminar']);
        Permission::create(['name' => 'vehiculos.informacion']);
        Permission::create(['name' => 'vehiculos.graficos']);
        Permission::create(['name' => 'vehiculos.imprimirLista']);

        Permission::create(['name' => 'vehiculos.listaAsignacion']);
        Permission::create(['name' => 'vehiculos.asignarNuevo']);
        Permission::create(['name' => 'vehiculos.asignarEditar']);
        Permission::create(['name' => 'vehiculos.asignarEliminar']);
        Permission::create(['name' => 'vehiculos.descargarPDFCargo']);

    
        Permission::create(['name' => 'vehiculos.siniestros']);
        Permission::create(['name' => 'vehiculos.altaSiniestro']);
        Permission::create(['name' => 'vehiculos.editarSiniestro']);
        Permission::create(['name' => 'vehiculos.eliminarSiniestro']);

        Permission::create(['name' => 'vehiculos.repuestos']);
        Permission::create(['name' => 'vehiculos.crearRepuestos']);
        Permission::create(['name' => 'vehiculos.descargarPDFRepuesto']);

        Permission::create(['name' => 'usuarios.listaUsuarios']);
        Permission::create(['name' => 'usuarios.asignarPermisosARoles']);
        Permission::create(['name' => 'usuarios.crear']);
        Permission::create(['name' => 'usuarios.asignarRol']);
        Permission::create(['name' => 'usuarios.eliminarUsuario']);
        Permission::create(['name' => 'usuarios.resetPassword']);

        Permission::create(['name' => 'dependencias.dependencias']);
        Permission::create(['name' => 'dependencias.crearDependencia']);
        Permission::create(['name' => 'dependencias.editarDependencia']);
        Permission::create(['name' => 'dependencias.eliminarDepencencia']);

        Permission::create(['name' => 'estados.altaEstado']);

        //creamos los roles
     	$SuperAdmin = Role::create(['name' => 'Super Admin']);
        $sinRol = Role::create(['name' => 'Sin Rol']);
        $Admin = Role::create(['name' => 'Admin']);
        $cargarVehiculos = Role::create(['name' => 'Cargar Vehiculos']);

        //asignamos los permisos a los roles
        $SuperAdmin->givePermissionTo([
            'vehiculos.index',
            'vehiculos.crear',
            'vehiculos.editar',
            'vehiculos.eliminar',
            'vehiculos.informacion',
            'vehiculos.graficos',

            'vehiculos.listaAsignacion',
            'vehiculos.asignarNuevo',
            'vehiculos.asignarEditar',
            'vehiculos.asignarEliminar',
            'vehiculos.descargarPDFCargo',

            'vehiculos.siniestros',
            'vehiculos.altaSiniestro',
            'vehiculos.editarSiniestro',
            'vehiculos.eliminarSiniestro',

            'vehiculos.repuestos',
            'vehiculos.crearRepuestos',
            'vehiculos.descargarPDFRepuesto',

            'usuarios.listaUsuarios',
            'usuarios.asignarPermisosARoles',
            'usuarios.crear',
            'usuarios.asignarRol',
            'usuarios.eliminarUsuario',
            'usuarios.resetPassword',

            'dependencias.dependencias',
            'dependencias.crearDependencia',
            'dependencias.editarDependencia',
            'dependencias.eliminarDepencencia',

            'estados.altaEstado',
        ]);

        $Admin->givePermissionTo([
            'vehiculos.index',
            'vehiculos.crear',
            'vehiculos.editar',
            'vehiculos.eliminar',
            'vehiculos.informacion',
            'vehiculos.graficos',

            'vehiculos.listaAsignacion',
            'vehiculos.asignarNuevo',
            'vehiculos.asignarEditar',
            'vehiculos.asignarEliminar',
            'vehiculos.descargarPDFCargo',

            'vehiculos.siniestros',
            'vehiculos.altaSiniestro',
            'vehiculos.editarSiniestro',
            'vehiculos.eliminarSiniestro',

            'vehiculos.repuestos',
            'vehiculos.crearRepuestos',
            'vehiculos.descargarPDFRepuesto',

            'usuarios.listaUsuarios',
            'usuarios.asignarPermisosARoles',
            'usuarios.crear',
            'usuarios.asignarRol',
            'usuarios.eliminarUsuario',
            'usuarios.resetPassword',

            'dependencias.dependencias',
            'dependencias.editarDependencia',
            'dependencias.eliminarDepencencia',

            'estados.altaEstado',
        ]);

        $cargarVehiculos->givePermissionTo([
            'vehiculos.index',
            'vehiculos.crear',
            'vehiculos.editar',
            'vehiculos.eliminar',
            'vehiculos.informacion',
            'vehiculos.graficos',

            'vehiculos.listaAsignacion',
            'vehiculos.asignarNuevo',
            'vehiculos.asignarEditar',
            'vehiculos.asignarEliminar',

            'vehiculos.siniestros',
            'vehiculos.altaSiniestro',
            'vehiculos.editarSiniestro',
            'vehiculos.eliminarSiniestro',

            'vehiculos.repuestos',
            'vehiculos.crearRepuestos',
            'vehiculos.descargarPDFRepuesto',
            
            'estados.altaEstado'
        ]);

    }
}
