<?php

namespace App\Http\Controllers;

use App\Models\User;
use Intervention\Image\Laravel\Facades\Image;


use Illuminate\Http\Request;

class UserProfilesController extends Controller
{
    /**
     * Show the User Profiles dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        return view('profiles.index', ['user' => $user, 'follows' => $follows]);
    }

    public function edit(User $user){    
        return view('profiles.edit', ['user' => $user]);
    }

    public function update(User $user){
        $data = request()->validate([
            'title'=> 'required',
            'description'=> 'required',
            'image'=> ['image'],
        ]);

        if(request('image')){
            $imagePath = (request('image')->store('profile', 'public'));

            $image = Image::read(public_path("storage/{$imagePath}"))->cover(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge($data, $imageArray ?? []));

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        return view('profiles.index', ['user' => $user, 'follows' => $follows]);
    }
}
