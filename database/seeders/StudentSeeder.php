<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['name' => 'John Doe'],
            ['name' => 'Jane Smith'],
            ['name' => 'Alice Johnson'],
            ['name' => 'Bob Brown'],
        ];

        foreach ($students as $studentData) {
            $firstName = Str::before($studentData['name'], ' ');
            $email = Str::lower($firstName) . '@gmail.com';

            $user = User::create([
                'name' => $studentData['name'],
                'email' => $email,
                'password'=> Hash::make('12345678'),
                'role' => 'student'
            ]);

            Student::create([
                'name' => $studentData['name'],
            ]);
        }
    }
}
