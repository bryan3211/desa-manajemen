<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'nik' => '3515011234567890',
        ], [
            'name' => 'Admin',
            'nik' => '3515011234567890',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_verified' => true,
        ]);

        User::updateOrCreate([
            'nik' => '3515019876543210',
        ], [
            'name' => 'User',
            'nik' => '3515019876543210',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user1234'),
            'role' => 'user',
            'is_verified' => true,
        ]);
    }
}