<?php

namespace App\Http\Controllers;

use App\Models\ImagePost;
use App\Models\TextPost;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

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

    public function likePost(Request $request, $postType, $postId)
    {
        $user = auth()->user();
        $post = null;

        // Log::debug('LikePost method triggered', ['postType' => $postType, 'postId' => $postId]);

        // Determine the post type and fetch the corresponding post
        if ($postType === 'tp') {
            $post = TextPost::find($postId);
        } elseif ($postType === 'ip') { // This matches 'ip' for image posts
            $post = ImagePost::find($postId);
        }

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        Log::debug($post);

        // Check if the user has already liked the post
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            // User has already liked the post, so remove the like
            $like->delete();
            return response()->json(['liked' => false, 'like_count' => $post->likeCount()]);
        } else {
            // User has not liked the post, so add the like
            $post->likes()->create(['user_id' => $user->id]);
            return response()->json(['liked' => true, 'like_count' => $post->likeCount()]);
        }
    }


    // Get the like count for a post
    public function getLikeCount($postId, $postType)
    {
        $post = null;

        // Determine which post type to look for
        if ($postType === 'text') {
            $post = TextPost::find($postId);
        } elseif ($postType === 'image') {
            $post = ImagePost::find($postId);
        }

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Return the like count
        return response()->json(['like_count' => $post->likeCount()]);
    }

}
