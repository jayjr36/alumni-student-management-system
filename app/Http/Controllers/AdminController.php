<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MentorRequest;


class AdminController extends Controller
{
    public function mentorRequests()
    {
        $mentorRequests = MentorRequest::where('status', 'pending')->get();
        return view('admin.mentor_requests', compact('mentorRequests'));
    }

    public function approveMentorRequest($id)
    {
        $mentorRequest = MentorRequest::findOrFail($id);
        $mentorRequest->update(['status' => 'approved']);
        return redirect()->route('admin.mentor.requests')->with('success', 'Mentor request approved.');
    }

    public function rejectMentorRequest($id)
    {
        $mentorRequest = MentorRequest::findOrFail($id);
        $mentorRequest->update(['status' => 'rejected']);
        return redirect()->route('admin.mentor.requests')->with('success', 'Mentor request rejected.');
    }
}
