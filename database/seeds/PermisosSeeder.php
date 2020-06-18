<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\User;


class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$permissions_array=[];
    	array_push($permissions_array,Permission::create(['name'=>'create_user']));
    	array_push($permissions_array,Permission::create(['name'=>'delete_user']));
    	array_push($permissions_array,Permission::create(['name'=>'edit_user']));
    	array_push($permissions_array,Permission::create(['name'=>'view_user']));
    	array_push($permissions_array,Permission::create(['name'=>'create']));
    	array_push($permissions_array,Permission::create(['name'=>'edit']));
    	array_push($permissions_array,Permission::create(['name'=>'delete']));
    	array_push($permissions_array,Permission::create(['name'=>'view']));
        $superAdmin=Role::create(['name'=>'super_admin']);
        $superAdmin->syncPermissions($permissions_array);

        $superAdminUser=User::create([
        	'name'=>'Admin',
        	'email'=>'mariokr.rocker@gmail.com',
        	'password'=>Hash::make('admin')
        ]);
        $superAdminUser->assignRole('super_admin');

    }
}
