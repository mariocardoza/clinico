<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$permissions_array=[];
        array_push($permissions_array,'view_user');
    	array_push($permissions_array,'create');
    	array_push($permissions_array,'edit');
    	array_push($permissions_array,'delete');
    	array_push($permissions_array,'view');
    	$user=Role::create(['name'=>'user']);
        $user->syncPermissions($permissions_array);

        $userU=User::create([
        	'name'=>'User',
        	'email'=>'mario_boyle@hotmail.com',
        	'password'=>Hash::make('usuario')
        ]);
        $userU->assignRole('user');
    }
}
