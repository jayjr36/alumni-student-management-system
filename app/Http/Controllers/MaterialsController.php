<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Classes;
use App\Models\ClassSubscriptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MaterialsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,txt,mp4,mp3,jpg,png,jpeg', // Add your allowed file types
            'class_id' => 'required|exists:classes,id'
        ]);
    
        // Get the file from the request
        $file = $request->file('file');
        
        // Generate a unique file name
        $fileName = time() . '_' . $file->getClientOriginalName();
        
        // Define the path to store the file
        $filePath = 'materials/' . $fileName;
        
        // Store the file in the public disk
        Storage::disk('public')->put($filePath, file_get_contents($file));
    
        // Create the material entry in the database
        Material::create([
            'title' => $request->input('title'),
            'file_path' => $filePath,
            'class_id' => $request->input('class_id'),
        ]);
    
        return redirect()->route('materials.create')->with('success', 'Material uploaded successfully.');
    }
    
    
    public function show($classId)
{
    $class = Classes::with('materials')->findOrFail($classId);

    // Ensure that the authenticated user is either the mentor or a subscribed student
    $user = Auth::user();
    $isAuthorized = $user->id === $class->mentor_id ||
                    ClassSubscriptions::where('class_id', $class->id)
                                      ->where('student_id', $user->guest_id)
                                      ->exists();

    if (!$isAuthorized) {
        abort(403, 'Unauthorized access');
    }

    return view('classes.materials', compact('class'));
}

public function create()
{
    $mentorId = Auth::user()->guest_id;
    $classes = Classes::where('mentor_id', $mentorId)->get();
    
    return view('classes.manage_classes', compact('classes'));
}

}
