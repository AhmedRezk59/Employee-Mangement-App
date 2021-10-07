<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'search employees',
            'show employees',
            'create employee',
            'delete employee',
            'edit employee',



            'show countries',
            'create country',
            'delete country',
            'edit country',

            'show states',
            'create state',
            'delete state',
            'edit state',

            'show cities',
            'create city',
            'delete city',
            'edit city',

            'show departments',
            'create department',
            'delete department',
            'edit department',

            'show users',
            'create user',
            'delete user',
            'edit user',

            'show roles',
            'create role',
            'delete role',
            'edit role',


        ];



        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);
        }
    }
}
