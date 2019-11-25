<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'nombre' => 'Sebastian Fernandes',
        	'usuario' => 'c261',
        	'password' => '34367714',
        	
        ]);
        
        $user = User::find(1);
        $user->assignRole('Admin');

    }
}
