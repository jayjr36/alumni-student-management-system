<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassSubscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ClassSubscriptionController extends Controller
{
    public function subscribe($classId)
    {
        $class = Classes::findOrFail($classId);

        if (ClassSubscriptions::where('class_id', $classId)
                             ->where('student_id', Auth::id())
                             ->exists()) {
            return redirect()->back()->with('error', 'Already subscribed to this class.');
        }

        ClassSubscriptions::create([
            'class_id' => $classId,
            'student_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Subscribed to class successfully.');
    }

    public function subscribedClasses()
    {
        $classes = Classes::whereHas('subscriptions', function ($query) {
            $query->where('student_id', Auth::id());
        })->get();

        return view('classes.subscribed', compact('classes'));
    }

    public function show($id)
{
    $class = Classes::findOrFail($id);
    $subscribers = $class->subscriptions()->with('student')->get();

    return view('classes.show', compact('class', 'subscribers'));
}

}
