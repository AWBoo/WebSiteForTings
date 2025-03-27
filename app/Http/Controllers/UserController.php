<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    public function showSearchPage()
    {
        return view('user.search'); 
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = [];
        if ($query) {
            $users = User::where('username', 'LIKE', "%{$query}%")
                ->orWhere('bio', 'LIKE', "%{$query}%")
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'username' => $user->username,
                        'profile_picture' => $user->profile->profileImage(), // Get the profile image
                        'bio' => $user->profile->description, // User bio
                    ];
                });
        }
    
        // Return a JSON response with the user data
        return response()->json($users);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
