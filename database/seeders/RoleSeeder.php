<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'super-admin'
        ])->permission()->attach([1, 2, 3, 4]);

        Role::create([
            'name' => 'admin'
        ])->permission()->attach([2, 3, 4, 5, 7]);

        Role::create([
            'name' => 'client'
        ])->permission()->attach([6, 8]);
    }
}
