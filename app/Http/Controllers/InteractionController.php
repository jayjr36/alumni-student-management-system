<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class InteractionController extends Controller
{
    public function index()
    {
        return view('interaction');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', '%' . $search . '%')->get();
        return view('interaction', ['users' => $users]);
    }
}
