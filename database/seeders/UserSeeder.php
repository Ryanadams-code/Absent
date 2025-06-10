<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a super admin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'role' => 'super admin',
            'password' => Hash::make('password'),
        ]);

        // Create 3 guru users
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => "Guru $i",
                'email' => "guru$i@example.com",
                'role' => 'guru',
                'password' => Hash::make('password'),
            ]);
        }

        // Create 5 murid users
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Murid $i",
                'email' => "murid$i@example.com",
                'role' => 'murid',
                'password' => Hash::make('password'),
            ]);
        }

        // Create 1 tata usaha user
        User::create([
            'name' => 'Tata Usaha',
            'email' => 'tu@example.com',
            'role' => 'tata usaha',
            'password' => Hash::make('password'),
        ]);
    }
}