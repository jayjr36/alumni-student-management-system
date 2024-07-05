<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Alumni;
use App\Models\MentorRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function showAlumni($id)
    {
        
        $alumni = Alumni::findOrFail($id);
        $mentorRequest = MentorRequest::where('alumni_id', $id)->first();
        return view('profiles.alumni', compact('alumni', 'mentorRequest'));
    }

    public function showStudent($id)
    {
        $student = Student::findOrFail($id);
        $mentors = $student->mentors()->wherePivot('status', 'accepted')->get();
        return view('profiles.student', compact('student', 'mentors'));
    }

    public function requestMentor($id)
    {
        $alumni = Alumni::findOrFail($id);
        MentorRequest::create(['alumni_id' => $id]);
        return redirect()->back()->with('success', 'Mentor request sent.');
    }

    public function approveMentorRequest($id)
    {
        $mentorRequest = MentorRequest::findOrFail($id);
        $mentorRequest->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Mentor request approved.');
    }

    public function rejectMentorRequest($id)
    {
        $mentorRequest = MentorRequest::findOrFail($id);
        $mentorRequest->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Mentor request rejected.');
    }

    public function requestMentorship($mentor_id, $student_id)
    {
        $mentor = Alumni::findOrFail($mentor_id);
        $student = Student::findOrFail($student_id);
        $mentor->mentees()->attach($student_id);
        return redirect()->back()->with('success', 'Mentorship request sent.');
    }

    public function respondMentorshipRequest($mentor_id, $student_id, $response)
    {
        $mentor = Alumni::findOrFail($mentor_id);
        $mentor->mentees()->updateExistingPivot($student_id, ['status' => $response]);
        return redirect()->back()->with('success', 'Mentorship request ' . $response . '.');
    }
}
