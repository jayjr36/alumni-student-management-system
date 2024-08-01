<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassSubscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ClassSubscriptionController extends Controller
{

    public function subscribeToClass(Request $request, $classId)
{
    // Validate the request
    $request->validate([
        'class_id' => 'required|exists:classes,id',
    ]);

    // Get the currently authenticated student
    $studentId = Auth::user()->guest_id; // Assuming guestid is used to identify the student

    // Check if the subscription already exists
    $subscriptionExists = ClassSubscriptions::where('class_id', $classId)
        ->where('student_id', $studentId)
        ->exists();

    if ($subscriptionExists) {
        return redirect()->back()->with('error', 'You are already subscribed to this class.');
    }

    // Create a new subscription
    ClassSubscriptions::create([
        'class_id' => $classId,
        'student_id' => $studentId,
    ]);

    return redirect()->back()->with('success', 'Subscribed to class successfully.');
}
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

        return view('classes.subscribed_classes', compact('classes'));
    }

    public function show($id)
{
    $class = Classes::findOrFail($id);
    $subscribers = $class->subscriptions()->with('student')->get();

    return view('classes.all_subscribers', compact('class', 'subscribers'));
}

}
