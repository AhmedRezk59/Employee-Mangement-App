<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');


     
        $role = Role::create(['name' => 'Admin']);
        $admin = User::create([
            'username' => 'ahmedrizk59',
            'first_name' => 'Ahmed',
            'last_name' => 'Rizk',
            'email' => 'rezk59315@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 'Admin',
            'role_id_fk' => 1
        ]);
        /** @var \App\User $user */
       
        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);
    }
}
