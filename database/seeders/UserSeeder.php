<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Rizal Danuarta Akbar',
            'email' => 'akbardanu631@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'User Dummy ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }
    }
}

