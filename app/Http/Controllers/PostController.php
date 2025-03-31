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
        // Ensure the user is authenticated
        if (!auth()->check()) {
            return view('user.index', ['imagePosts' => collect(), 'textPosts' => collect()]);
        }

        $user = auth()->user();

        // Get the list of user IDs that the authenticated user is following
        $users = $user->following()->pluck('user_profiles.user_id');

        // If the user follows no one, return empty collections
        if ($users->isEmpty()) {
            return view('user.index', ['imagePosts' => collect(), 'textPosts' => collect()]);
        }

        // Eager load the 'user.profile' relationship, and filter posts from followed users
        $imagePosts = ImagePost::with('user.profile')
            ->whereIn('user_id', $users)
            ->latest()
            ->get();

        $textPosts = TextPost::with('user.profile')
            ->whereIn('user_id', $users)
            ->latest()
            ->get();

        return view('user.index', compact('imagePosts', 'textPosts'));
    }

}
