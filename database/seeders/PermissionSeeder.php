<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionsAdmin = [
            ['name' => 'admin_show'],
            ['name' => 'admin_store'],
            ['name' => 'admin_update'],
            ['name' => 'admin_destroy']
        ];

        $permissionUser = [
            ['name' => 'user_show'],
            ['name' => 'user_store'],
            ['name' => 'user_update'],
            ['name' => 'user_destroy']
        ];

        foreach ($permissionsAdmin as $permission) {
            Permission::create($permission)->assignRole('super_admin');
        }
        foreach ($permissionUser as $permission) {
            Permission::create($permission)->assignRole('user');
        }
    }
}
