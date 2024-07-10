<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('admin.addpost');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for the image
        ]);
    
        try {
            // Handle the file upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('images', 'public');
            }
    
            // Create and save the post
            Post::create([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'image' => $imagePath,
            ]);
    
            return redirect()->route('post.create')->with('success', 'Post added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('post.create')->with('error', 'Failed to add post. Please try again.');
        }
    }
    
    public function index()
    {
      $posts = Post::all();
      return view('admin.posts', compact('posts'));
    }
    
    public function update(Request $request, $id)
    {
      $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
      ]);

      try{

      }catch (\Exception $e) {
            
        return redirect()->route('posts.index')->with('error', 'Failed to update post. Please try again.');
    }
      $post = Post::find($id);
      $post->update($request->all());

      return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }
   
    public function destroy($id)
    {
        try{
      $post = Post::find($id);
      $post->delete();
      return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        }catch (\Exception $e) {
            return redirect()->route('posts.index')->with('error', 'Failed to delete post. Please try again.');
        }
    }

    public function show($id)
    {

      $post = Post::find($id);
      return view('posts.show', compact('post'));
    }
    
    public function edit($id)
    {
        try{
      $post = Post::find($id);
      return view('admin.editpost', compact('post'));
      
        }catch (\Exception $e) {
            
            return redirect()->route('posts.index')->with('error', 'Failed to edit post. Please try again.');
        }
    }
}
