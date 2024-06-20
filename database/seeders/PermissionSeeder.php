<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name' => 'manage_permissions'],
            ['name' => 'manage_roles'],
            ['name' => 'manage_role_permissions'],
            ['name' => 'manage_users'],
            ['name' => 'manage_campaigns'],
            ['name' => 'manage_self_campaigns'],
            ['name' => 'manage_credits'],
            ['name' => 'view_credits'],
        ]);
    }
}
