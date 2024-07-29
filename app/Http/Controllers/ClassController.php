<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ClassController extends Controller
{
    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Classes::create([
            'mentor_id' => Auth::id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
    }

    public function index()
    {
        $classes = Classes::where('mentor_id', Auth::id())->get();
        return view('classes.index', compact('classes'));
    }
}
