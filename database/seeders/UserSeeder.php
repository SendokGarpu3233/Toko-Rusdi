<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        user::updateOrCreate(
            ['email' => 'wawan@gmail.com'],
            ['name'  => 'wawan', 'role' => 'admin', 'password' => Hash::make('password123')],
        );

        user::updateOrCreate(
            ['email' => 'superadmin@gmail.com'],
            ['name'  => 'Super Admin', 'role' => 'super_admin', 'password' => Hash::make('password123')]
        );
    }
}