<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
        $request->validate([
            'graduation_year' => 'required|string|max:4',
            'degree' => 'required|string|max:255',
            'bio' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        $alumni = Alumni::where('id', Auth::user()->guest_id)->firstOrFail();
    
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/profile_pictures'), $filename);
    
            // If there was an old profile picture, delete it
            if ($alumni->profile_picture) {
                File::delete(public_path('images/profile_pictures/' . $alumni->profile_picture));
            }
    
            // Save new profile picture filename
            $alumni->profile_picture = $filename;
        }
    
        $alumni->graduation_year = $request->input('graduation_year');
        $alumni->degree = $request->input('degree');
        $alumni->bio = $request->input('bio');
        $alumni->save();
    
        return redirect()->route('alumni_profile', $alumni->id)->with('success', 'Profile updated successfully.');
    }

    // public function index()
    // {
    //     $alumni = Alumni::all();
    //     return view('alumni.index', compact('alumni'));
    // }

    public function show(Request $request)
    {
        $alumnus = Alumni::find($request->id);
        return view('profiles.alumni', compact('alumnus'));
    }

    public function destroy($id)
    {
        $alumnus = Alumni::findOrFail($id);
        $alumnus->delete();
        return redirect()->route('alumni.index')->with('success', 'Alumnus deleted successfully.');
    }
    
}
