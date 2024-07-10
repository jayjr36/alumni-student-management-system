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
            ['name' => 'John Doe', 'regNumber' => 'STU001'],
            ['name' => 'Jane Smith', 'regNumber' => 'STU002'],
            ['name' => 'Alice Johnson', 'regNumber' => 'STU003'],
            ['name' => 'Bob Brown', 'regNumber' => 'STU004'],
        ];

        foreach ($students as $studentData) {
            $firstName = Str::before($studentData['name'], ' ');
            $email = Str::lower($firstName) . '@gmail.com';

             $student = Student::create([
                'name' => $studentData['name'],
                'regNumber' => $studentData['regNumber'],
               // 'user_id' => $user->id // assuming you have a user_id field to link with the User model
            ]);

            $user = User::create([
                'name' => $studentData['name'],
                'email' => $email,
                'password'=> Hash::make('12345678'),
                'role' => 'student',
                'guest_id'=> $student->id
            ]);

            
        }
    }
}