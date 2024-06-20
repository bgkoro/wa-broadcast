<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'dofirfauzi@gmail.com',
            'role_id' => '1',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@company.com',
            'role_id' => '2',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
    }
}
