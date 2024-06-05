<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MentorshipOffer;

    class MentorshipOfferController extends Controller
{
    public function index()
    {
        $mentorshipOffers = MentorshipOffer::all();
        return view('mentorship_offers.index', compact('mentorshipOffers'));
    }

    public function create()
    {
        return view('mentorship_offers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        MentorshipOffer::create([
            'alumni_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('mentorship_offers.index')->with('success', 'Mentorship offer created successfully.');
    }

    public function edit(MentorshipOffer $mentorshipOffer)
    {
        return view('mentorship_offers.edit', compact('mentorshipOffer'));
    }

    public function update(Request $request, MentorshipOffer $mentorshipOffer)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $mentorshipOffer->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('mentorship_offers.index')->with('success', 'Mentorship offer updated successfully.');
    }

    public function destroy(MentorshipOffer $mentorshipOffer)
    {
        $mentorshipOffer->delete();
        return redirect()->route('mentorship_offers.index')->with('success', 'Mentorship offer deleted successfully.');
    }
}

