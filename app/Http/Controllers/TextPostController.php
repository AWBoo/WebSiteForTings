<?php

namespace App\Http\Controllers;

use App\Models\TextPost;

use Illuminate\Http\Request;

class TextPostController extends Controller
{
    public function show(TextPost $post)
    {
        // Eager load comments with users and profiles, and order by the latest comment
        $post = $post->load(['comments' => function ($query) {
            $query->latest(); // Orders comments by the latest first
        }, 'comments.user.profile']);

        // Check if the authenticated user is following the post owner
        $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;

        // Return the view with the post and follow status
        return view('posts.textShow', ['post' => $post, 'follows' => $follows]);
    }

    public function store()
    {
        $data = request()->validate([
            'description'=> 'required'
        ]);

        auth()->user()->textPosts()->create([
            'description'=> $data['description']
        ]);	

        return redirect('/profile/' . auth()->user()->id);
    }
}
