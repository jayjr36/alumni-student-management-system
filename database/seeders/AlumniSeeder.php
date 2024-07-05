<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alumni;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alumniData = [
            ['name' => 'Michael Scott', 'regNumber' => 'ALU001'],
            ['name' => 'Dwight Schrute', 'regNumber' => 'ALU002'],
            ['name' => 'Pam Beesly', 'regNumber' => 'ALU003'],
            ['name' => 'Jim Halpert', 'regNumber' => 'ALU004'],
        ];

        foreach ($alumniData as $alum) {
            // Extract the first name to generate the email
            $firstName = Str::before($alum['name'], ' ');
            $email = Str::lower($firstName) . '@gmail.com';

            $alumni =  Alumni::create([
                'name' => $alum['name'],
                'regNumber' => $alum['regNumber'],
               // 'user_id' => $user->id // assuming you have a user_id field to link with the User model
            ]);
            // Create the user account
            $user = User::create([
                'name' => $alum['name'],
                'email' => $email,
                'password' => Hash::make('12345678'),
                'role' => 'alumni',
                'guest_id' => $alumni->id
            ]);

            // Create the alumni record linked to the user
          
        }
    }}
