<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class JuzgadosPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Permission::create(['name' => 'juzgado.index']);
        Permission::create(['name' => 'juzgado.crear']);
        Permission::create(['name' => 'juzgado.editar']);
        Permission::create(['name' => 'juzgado.eliminar']);
        Permission::create(['name' => 'juzgado.informacion']);

        $SuperAdmin = Role::find(1);
        $Admin = Role::find(3);

        $SuperAdmin->givePermissionTo([
            'juzgado.index',
            'juzgado.crear',
            'juzgado.editar',
            'juzgado.eliminar',
            'juzgado.informacion'
        ]);

        $Admin->givePermissionTo([
            'juzgado.index',
            'juzgado.crear',
            'juzgado.editar',
            'juzgado.eliminar',
            'juzgado.informacion'
       	]);

    }
}
