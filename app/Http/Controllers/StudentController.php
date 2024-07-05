<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.studentslist', compact('students'));
    }

    public function create()
    {
        return view('admin.addstudents');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:students|max:255',
            'regNumber' => 'required'
        ]);

        Student::create($request->all());

        return redirect()->route('students.create')->with('success', 'Student added successfully');

    }

    public function editProfileForm()
    {
        $student = Auth::user()->guest_id; // Assuming student relationship is defined in User model

        return view('profiles.edit-student', compact('student'));
    }

    
public function updateProfile(Request $request)
{
    $student = Student::findOrFail(Auth::user()->guest_id); // Fetch student by ID

    $student->update([
        'year' => $request->input('year'),
        'major' => $request->input('major'),
        'bio' => $request->input('bio'),
    ]);

    return redirect()->route('profiles.student')->with('success', 'Profile updated successfully.');
}
}
