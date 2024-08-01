<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MentorMentee;
use App\Models\Student;

class ClassController extends Controller
{
    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Classes::create([
            'mentor_id' => Auth::user()->guest_id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
    }

    public function index()
    {
        $classes = Classes::where('mentor_id', Auth::user()->guest_id)->get();
        return view('classes.index', compact('classes'));
    }

    public function studentClasses()
    {
        $userId = Auth::id();
        $guestId = Auth::user()->guestid;
    
        // Fetch all mentors for the current student
        $mentorIds = MentorMentee::where('student_id', $guestId)
            ->where('status', 'accepted')
            ->pluck('mentor_id');
    
        // Fetch classes by mentors for the current student
        $classes = Classes::whereIn('mentor_id', $mentorIds)->get();
    
        return view('classes.student_classes', compact('classes'));
    }

//     public function mentorClasses($mentorId)
// {
//     $classes = Classes::where('mentor_id', $mentorId)->get();

//     return view('classes.student_classes', compact('classes'));
// }

public function mentorClasses()
{
    // Get the student's guestid from the users table
    $studentGuestId = Auth::user()->guest_id;
    
    // Find the mentor ID from the mentor_mentee table where the student is associated and the status is 'accepted'
    $mentorId = MentorMentee::where('student_id', $studentGuestId)
        ->where('status', 'accepted')
        ->pluck('mentor_id')
        ->first();

    if (!$mentorId) {
        // Handle case where no mentor is found or mentor hasn't accepted the student
        return redirect()->route('some.route')->with('error', 'No approved mentor found.');
    }

    // Fetch classes created by the mentor
    $classes = Classes::where('mentor_id', $mentorId)->get();

    return view('classes.student_classes', compact('classes'));
}


    
}
