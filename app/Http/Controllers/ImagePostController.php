<?php

namespace App\Http\Controllers;

use App\Models\ImagePost;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\Request;

class ImagePostController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('user_profiles.user_id');

        $posts = ImagePost::whereIn('user_id', $users)->latest()->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show(ImagePost $post)
    {
        // Eager load comments with users and profiles, and order by the latest comment
        $post = $post->load(['comments' => function ($query) {
            $query->latest(); // Orders comments by the latest first
        }, 'comments.user.profile']);

        // Check if the authenticated user is following the post owner
        $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;

        // Return the view with the post and follow status
        return view('posts.imageShow', ['post' => $post, 'follows' => $follows]);
    }

    public function store()
    {
        $data = request()->validate([
            'caption'=> 'required',
            'image'=> ['required', 'image'],
        ]);

        $imagePath = (request('image')->store('uploads', 'public'));
        auth()->user()->imagePosts()->create([
            'caption'=> $data['caption'],
            'image'=> $imagePath,
        ]);	

        $image = Image::read(public_path("storage/{$imagePath}"))->cover(1200, 1200);
        $image->save();

        return redirect('/profile/' . auth()->user()->id);
    }
}
