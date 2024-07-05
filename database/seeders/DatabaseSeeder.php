<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminEmail = 'admin@gmail.com';
        $adminPassword = '123456789';

        User::create([
            'name' => 'Admin User',
            'email' => $adminEmail,
            'password' => Hash::make($adminPassword),
            'role' => 'admin'
        ]);

        $this->call([
            StudentSeeder::class,
            AlumniSeeder::class,
        ]);
    }
}
