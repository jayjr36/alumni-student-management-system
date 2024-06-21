<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $messages = ForumPost::orderBy('created_at', 'desc')->get();
        
        return view('forum.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255', 
        ]);

        $message = new ForumPost();
        $message->user_id = auth()->id(); 
        $message->content = $request->content;
        $message->save();

        return response()->json(['message' => 'Message posted successfully']);
    }

    public function update(Request $request, ForumPost $post)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $post->update([
            'content' => $request->content,
        ]);

        return redirect()->route('forum.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(ForumPost $post)
    {
        $post->delete();

        return redirect()->route('forum.index')->with('success', 'Post deleted successfully.');
    }

    public function fetchMessages()
    {
        // Fetch messages to send as response (for AJAX request)
        $messages = ForumPost::orderBy('created_at', 'desc')->get();
        
        // Return messages as JSON response
        return response()->json(['messages' => $messages]);
    }
}
