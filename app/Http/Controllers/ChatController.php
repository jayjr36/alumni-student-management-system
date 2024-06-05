<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $receiver_id = $request->input('receiver_id');
        return view('chat');
    }

    public function sendMessage(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|string',
        'message' => 'required|string'

    ]);
    try {
        Message::create([
            'sender_id' =>  auth()->id(),
            'receiver_id' =>  $request->input('receiver_id'),
            'message' =>  $request->input('message'),
        ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {

        Log::error('Error saving message: ' . $e->getMessage());

        return response()->json(['success' => false, 'error' => 'Error saving message'], 500);
    }
}
    public function receiveMessage(Request $request)
    {
        $messages = Message::where('receiver_id', auth()->id())->get();
        return response()->json(['messages' => $messages]);
    }

    public function fetchMessages(Request $request)
{
    $receiver_id = $request->input('receiver_id');

    $messages = Message::where(function($query) use ($receiver_id) {
        $query->where('sender_id', auth()->id())
              ->where('receiver_id', $receiver_id);
    })->orWhere(function($query) use ($receiver_id) {
        $query->where('sender_id', $receiver_id)
              ->where('receiver_id', auth()->id());
    })->get();

    return response()->json(['messages' => $messages]);
}

public function recentContacts()
{
    $userId = Auth::id();

    $recentContacts = Message::where('sender_id', $userId)
        ->orWhere('receiver_id', $userId)
        ->with('sender', 'receiver')
        ->get()
        ->map(function ($message) use ($userId) {
            return $message->sender_id === $userId ? $message->receiver : $message->sender;
        })
        ->unique('id')
        ->values();

    return view('recent-contacts', compact('recentContacts'));
}

}
