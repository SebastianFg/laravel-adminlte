<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisosDepositoJudicialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Permission::create(['name' => 'deposito.index']);
        Permission::create(['name' => 'deposito.crear']);
        Permission::create(['name' => 'deposito.editar']);
        Permission::create(['name' => 'deposito.eliminar']);
        Permission::create(['name' => 'deposito.informacion']);
     

        $SuperAdmin = Role::find(1);
        $Admin = Role::find(3);
        $cargarVehiculo = Role::find(4);

        $SuperAdmin->givePermissionTo([
            'deposito.index',
            'deposito.crear',
            'deposito.editar',
            'deposito.eliminar',
            'deposito.informacion'
        ]);

        $Admin->givePermissionTo([
            'deposito.index',
            'deposito.crear',
            'deposito.editar',
            'deposito.eliminar',
            'deposito.informacion'
       	]);

        $cargarVehiculo->givePermissionTo([
            'deposito.index',
            'deposito.crear',
            'deposito.editar',
            'deposito.eliminar',
            'deposito.informacion'
       	]);
    }
}
