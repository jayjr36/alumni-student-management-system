<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MentorshipRequest;

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

public function accept(MentorshipRequest $mentorshipRequest)
{
    $mentorshipRequest->accepted = true;
    $mentorshipRequest->save();

    return redirect()->route('mentorship_requests.new')->with('success', 'Request accepted.');
}

public function reject(MentorshipRequest $mentorshipRequest)
{
    $mentorshipRequest->accepted = false;
    $mentorshipRequest->save();
  //  $mentorshipRequest->delete();

    return redirect()->route('mentorship_requests.index')->with('success', 'Request rejected.');
}
}
