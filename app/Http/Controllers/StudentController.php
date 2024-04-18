<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

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
        ]);

        Student::create($request->all());

        return redirect()->route('admin.studentslist')->with('success', 'Student added successfully');

    }
}
