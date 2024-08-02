<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Alumni;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\MentorRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $student = Student::findOrFail($student_id);
        
        $approvedMentors = Alumni::whereHas('mentorRequests', function ($query) {
            $query->where('status', 'approved');
        })->get();
        
        $mentorsAcceptedByStudent = Alumni::whereHas('mentorMentees', function ($query) use ($student_id) {
            $query->where('student_id', $student_id)
                  ->where('status', 'accepted');
        })->get();
        
        $mentorClasses = [];
        foreach ($mentorsAcceptedByStudent as $mentor) {
            $mentorClasses[$mentor->id] = Classes::where('mentor_id', $mentor->id)->get();
        }
        
        return view('mentorship_offers.index', compact('student', 'approvedMentors', 'mentorsAcceptedByStudent', 'mentorClasses'));
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
            $mentor = Alumni::findOrFail($mentor_id);
    
            $student = Student::findOrFail($student_id);
    
            if ($mentor->mentees()->where('student_id', $student_id)->exists()) {
                return redirect()->back()->with('error', 'You have already requested mentorship from this mentor.');
            }
    
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

public function showprofile($guestId)
{
    Log::info("Fetching profile for guestId: $guestId"); // Log request

    $user = User::where('guest_id', $guestId)->first();

    if (!$user) {
        Log::info("User not found: $guestId"); // Log if user not found
        return response()->json(['error' => 'User not found'], 404);
    }

    if (Student::where('id', $guestId)->exists()) {
        $profile = Student::find($guestId);
    } elseif (Alumni::where('id', $guestId)->exists()) {
        $profile = Alumni::find($guestId);
    } else {
        Log::info("Profile not found for guestId: $guestId"); // Log if profile not found
        return response()->json(['error' => 'Profile not found'], 404);
    }

    Log::info("Profile found: ", $profile->toArray()); // Log profile data
    return response()->json($profile);
}


}
