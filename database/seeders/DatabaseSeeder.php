<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::create([
            'name' => 'Admin User',
            'email' => 'admin@wawekezaji.com',
            'phone_number' => '+255712395987',
            'password' => Hash::make('Wawekezaji@1992'), // Change to a secure password
            'user_type' => 'admin',
            'subscription_tier' => 'premium',
            'subscription_expires_at' => now()->addYear(1),
            'is_active' => true,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
