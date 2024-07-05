<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::all();
        return view('admin.alumnilist', compact('alumni'));
    }

    public function create()
    {
        return view('admin.addalumni');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'regNumber' => 'required'
        ]);

        Alumni::create($request->all());

        return redirect()->route('alumni.create')
            ->with('success', 'Alumni added successfully');
    }

    public function editProfileForm()
    {
        $alumni = Auth::user()->guest_id; // Assuming alumni relationship is defined in User model

        return view('profiles.edit-alumni', compact('alumni'));
    }

    public function updateProfile(Request $request)
    {
        $alumni = Alumni::where('id', Auth::user()->guest_id)->firstOrFail(); // Fetch alumni by ID
    
        $alumni->update([
            'graduation_year' => $request->input('graduation_year'),
            'degree' => $request->input('degree'),
            'bio' => $request->input('bio'),
        ]);
    
        return redirect()->route('alumni_profile')->with('success', 'Profile updated successfully.');
    }
}
