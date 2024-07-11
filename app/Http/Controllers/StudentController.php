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
        // Delete old profile picture if exists
        if ($student->profile_picture) {
            Storage::delete('public/profile_pictures/' . $student->profile_picture);
        }

        // Store new profile picture
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
    
// public function updateProfile(Request $request)
// {
//     $student = Student::findOrFail(Auth::user()->guest_id); // Fetch student by ID

//     $student->update([
//         'year' => $request->input('year'),
//         'major' => $request->input('major'),
//         'bio' => $request->input('bio'),
//     ]);

//     return redirect()->route('profiles.student')->with('success', 'Profile updated successfully.');
// }
}
