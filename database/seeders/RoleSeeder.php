<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'employee',
                'guard_name' => 'web',
            ],
            [
                'name' => 'driver',
                'guard_name' => 'web',
            ],
            [
                'name' => 'client',
                'guard_name' => 'web',
            ],
        ];

        foreach($roles as $role){
            Role::create($role);
        }

    }
}
