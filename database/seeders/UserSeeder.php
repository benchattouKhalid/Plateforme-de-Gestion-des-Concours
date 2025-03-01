<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Create Gestionnaire Globale Account
                User::create([
                    'name' => 'Gestionnaire Globale',
                    
                    'email' => 'gestionnaire.global@example.com',
                    'password' => Hash::make('password123'), // Secure password
                    'role' => 'gestionnaire_global',
                ]);

                // Create Gestionnaire Locale Account
                User::create([
                    'name' => 'Gestionnaire Locale',

                    'email' => 'gestionnaire.locale@example.com',
                    'password' => Hash::make('password123'), // Secure password
                    'role' => 'gestionnaire_local',
                ]);

    }
}
