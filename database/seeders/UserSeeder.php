<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // User 
        DB::table('users')->insert([
            'name' => 'Zahro',
            'email' => 'zahro@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin
        DB::table('users')->insert([
            'name' => 'Admin Super',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
