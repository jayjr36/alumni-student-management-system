<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Alumni;
use App\Models\MentorRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
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

    // public function studentMentors($id){
    //     $student = Student::findOrFail($id);
    //     $mentors = $student->mentors()->wherePivot('status', 'accepted')->get();
    //     return view('mentorship_offers.index', compact('student', 'mentors'));
    // }

    public function studentMentors($student_id)
    {
        // Fetch the student or fail
        $student = Student::findOrFail($student_id);
    
        // Fetch mentors who have approved mentorship requests (status = 'approved') for any student
        $approvedMentors = Alumni::whereHas('mentorRequests', function ($query) {
            $query->where('status', 'approved');
        })->get();
    
        // Fetch mentors who have accepted mentorship requests (status = 'accepted') for the specific student
        $mentorsAcceptedByStudent = Alumni::whereHas('mentorMentees', function ($query) use ($student_id) {
            $query->where('student_id', $student_id)
                  ->where('status', 'accepted');
        })->get();
    
        return view('mentorship_offers.index', compact('student', 'approvedMentors', 'mentorsAcceptedByStudent'));
    }
    

    

    
    
    public function alumniMentors($id)
    {
        // Find the alumni by ID or fail
        $alumni = Alumni::findOrFail($id);
    
        // Fetch mentorship requests from the mentor_mentee table
        $mentorshipRequests = DB::table('mentor_mentee')
            ->where('mentor_id', $id)
            ->join('students', 'mentor_mentee.student_id', '=', 'students.id')
            ->select('mentor_mentee.*', 'students.name as student_name')
            ->get();
    
        // Return view with the fetched data
        return view('mentorship_requests.index', compact('alumni', 'mentorshipRequests'));
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
        try {
            // Check if mentor exists
            $mentor = Alumni::findOrFail($mentor_id);
    
            // Check if student exists
            $student = Student::findOrFail($student_id);
    
            // Check if the mentorship request already exists
            if ($mentor->mentees()->where('student_id', $student_id)->exists()) {
                return redirect()->back()->with('error', 'You have already requested mentorship from this mentor.');
            }
    
            // Attach the student to the mentor
            $mentor->mentees()->attach($student_id);
    
            return redirect()->back()->with('success', 'Mentorship request sent.');
    
        } catch (ModelNotFoundException $e) {
            // Handle cases where the mentor or student is not found
            return redirect()->back()->with('error', 'Mentor or student not found.');
        } catch (\Exception $e) {
            // Handle any other exceptions
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
    

    public function respondMentorshipRequest($mentor_id, $student_id, $response)
    {
        $mentor = Alumni::findOrFail($mentor_id);
        $mentor->mentees()->updateExistingPivot($student_id, ['status' => $response]);
        return redirect()->back()->with('success', 'Mentorship request ' . $response . '.');
    }
}
