<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

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
        ]);

        Alumni::create($request->all());

        return redirect()->route('alumni.create')
            ->with('success', 'Alumni added successfully');
    }
}
