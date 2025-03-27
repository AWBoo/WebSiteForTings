<?php

namespace App\Http\Controllers;

use App\Models\ImagePost;
use App\Models\TextPost;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function explore()
    {
        $imagePosts = ImagePost::with('user.profile')->latest()->get();
        $textPosts = TextPost::with('user.profile')->latest()->get();

        $imagePosts = $imagePosts->sortByDesc('created_at');
        $textPosts =  $textPosts->sortByDesc('created_at');

        return view('user.explore', compact('imagePosts', 'textPosts'));
    }

    public function index()
    {
        // Get the users that the authenticated user is following
        $users = auth()->user()->following()->pluck('user_profiles.user_id');

        // Eager load the 'user.profile' relationship, and filter posts from followed users
        $imagePosts = ImagePost::with('user.profile')
            ->whereIn('user_id', $users)  // Filter only posts from followed users
            ->latest()
            ->get();

        $textPosts = TextPost::with('user.profile')
            ->whereIn('user_id', $users)  // Filter only posts from followed users
            ->latest()
            ->get();

        // Sort posts by the created_at column in descending order
        $imagePosts = $imagePosts->sortByDesc('created_at');
        $textPosts = $textPosts->sortByDesc('created_at');

        // dd($imagePosts, $textPosts);

        // Return the view with the image and text posts
        return view('user.index', compact('imagePosts', 'textPosts'));
    }
}
