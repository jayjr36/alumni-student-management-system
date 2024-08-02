<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
    $request->validate([
        'email' => 'required|email',
        'year' => 'required',
        'major' => 'required',
        'bio' => 'nullable',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $student = Student::where('id', Auth::user()->guest_id)->firstOrFail();
    
    $student->email = $request->input('email');
    $student->year = $request->input('year');
    $student->major = $request->input('major');
    $student->bio = $request->input('bio');

    if ($request->hasFile('profile_picture')) {
        if ($student->profile_picture) {
            Storage::delete('public/profile_pictures/' . $student->profile_picture);
        }

        $fileName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->storeAs('public/profile_pictures', $fileName);
        $student->profile_picture = $fileName;
    }

    $student->save();

    return redirect()->route('student_profile', $student->id)->with('success', 'Profile updated successfully.');
}


public function destroy($id)
{
    $student = Student::findOrFail($id); // Find the student by ID

    // Perform deletion
    $student->delete();

    // Redirect back with success message
    return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
}

// Display student profile (modal popup)
public function profile($id)
{
    $student = Student::findOrFail($id); // Find the student by ID
    return view('students.profile', compact('student'));
}
public function edit($id)
{
    $student = Student::findOrFail($id);
    return view('students.edit', compact('student'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'regNumber' => 'required|string|max:255',
        'year' => 'nullable|integer',
        'major' => 'nullable|string|max:255',
        'bio' => 'nullable|string',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $student = Student::findOrFail($id);
    $student->name = $request->name;
    $student->regNumber = $request->regNumber;
    $student->year = $request->year;
    $student->major = $request->major;
    $student->bio = $request->bio;

    if ($request->hasFile('profile_picture')) {
        $imageName = time().'.'.$request->profile_picture->extension();
        $request->profile_picture->move(public_path('images'), $imageName);
        $student->profile_picture = $imageName;
    }

    $student->save();

    return redirect()->route('students.index')->with('success', 'Student profile updated successfully.');
}
}
