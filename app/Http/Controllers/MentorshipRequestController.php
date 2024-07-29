<?php

namespace App\Http\Controllers;

use App\Models\MentorMentee;
use Illuminate\Http\Request;
use App\Models\MentorshipRequest;
use Illuminate\Support\Facades\Log;


class MentorshipRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mentorship_offer_id' => 'required|exists:mentorship_offers,id',
        ]);

        MentorshipRequest::create([
            'student_id' => auth()->id(),
            'mentorship_offer_id' => $request->mentorship_offer_id,
        ]);

        return back()->with('success', 'Mentorship request sent successfully.');
    }

    public function index()
{
    $mentorshipRequests = MentorshipRequest::whereHas('mentorshipOffer', function ($query) {
        $query->where('alumni_id', auth()->id());
    })->with('student')->get();

    return view('mentorship_requests.index', compact('mentorshipRequests'));
}

public function accept(Request $request, $id)
{
    try {
        $mentorshipRequest = MentorMentee::findOrFail($id);
        $mentorshipRequest->status = 'accepted';
        $mentorshipRequest->save();

        return redirect()->route('mentorship_requests.new')->with('success', 'Mentorship request accepted.');

    } catch (\Exception $e) {
        Log::error('Error accepting mentorship request: ' . $e->getMessage());
        return redirect()->route('mentorship_requests.new')->with('error', 'An error occurred while accepting the request.');
    }
}
public function reject(Request $request, $id)
{
    try {
        $mentorshipRequest = MentorMentee::findOrFail($id);
        $mentorshipRequest->status = 'rejected';
        $mentorshipRequest->save();

        return redirect()->route('mentorship_requests.new')->with('success', 'Mentorship request rejected.');

    } catch (\Exception $e) {
        Log::error('Error rejecting mentorship request: ' . $e->getMessage());
        return redirect()->route('mentorship_requests.new')->with('error', 'An error occurred while rejecting the request.');
    }
}
}
