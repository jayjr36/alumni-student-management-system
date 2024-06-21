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
            ['name' => 'Michael Scott'],
            ['name' => 'Dwight Schrute'],
            ['name' => 'Pam Beesly'],
            ['name' => 'Jim Halpert'],
        ];

        foreach ($alumniData as $alum) {
            // Extract the first name to generate the email
            $firstName = Str::before($alum['name'], ' ');
            $email = Str::lower($firstName) . '@gmail.com';

            // Create the user account
            $user = User::create([
                'name' => $alum['name'],
                'email' => $email,
                'password'=> Hash::make('12345678'),
                'role' => 'alumni'
            ]);

            // Create the alumni record linked to the user
            Alumni::create([
                'name' => $alum['name'],

            ]);
        }
    }
}
