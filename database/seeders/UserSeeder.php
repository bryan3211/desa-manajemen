<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User dengan NIK
        DB::table('users')->insert([
            'name' => 'Admin Desa',
            'nik' => '3515011234567890',
            'email' => 'admin@desa.local',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_verified' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Regular User dengan NIK
        DB::table('users')->insert([
            'name' => 'Warga Desa',
            'nik' => '3515019876543210',
            'email' => 'warga@desa.local',
            'password' => Hash::make('warga123'),
            'role' => 'user',
            'is_verified' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // User tanpa email (hanya NIK)
        DB::table('users')->insert([
            'name' => 'User Tanpa Email',
            'nik' => '3515011111111111',
            'email' => null,
            'password' => Hash::make('password123'),
            'role' => 'user',
            'is_verified' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}