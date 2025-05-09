<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@wedance.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Teacher
        User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@wedance.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // Regular User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@wedance.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
