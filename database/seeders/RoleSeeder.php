<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Whoops\Run;

class RoleSeeder extends Seeder{

    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin'
            ],
            [
                'name' => 'user'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}