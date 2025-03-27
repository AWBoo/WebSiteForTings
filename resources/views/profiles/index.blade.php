@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Profile Header Section -->
    <div class="row">
        <div class="col-md-4 text-center text-md-start p-5">
            <img src="{{ $user->profile->profileImage() }}" 
                 alt="Profile Image" class="img-fluid rounded-circle w-75">
        </div>
        <div class="col-md-8 pt-5">
            <div class="d-flex justify-content-between align-items-baseline mb-4">
                <div class="d-flex align-items-center">
                    <h1 class="m-0">{{ $user->username }}</h1>

                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
            </div>

            <!-- Conditionally Display Edit and Add New Post Buttons -->
            @can('update', $user->profile)
                <div class="d-flex mb-3">
                    <a href="/profile/{{ $user->id }}/edit" class="btn btn-outline-primary btn-m me-3">Edit Profile</a>
                    <a href="/ip/create" class="btn btn-outline-primary btn-m">Add New Post</a>
                </div>
            @endcan

            <div class="d-flex pt-3">
                <div class="pe-5"><strong>Followers</strong> {{ $user->profile->followers->count() }}</div>
                <div class="pe-5"><strong>Following</strong> {{ $user->following->count() }}</div>
                <div><strong>Posts</strong> {{ $user->imagePosts->count() + $user->textPosts->count() }}</div>
            </div>

            <div class="pt-4">
                <h3 class="fw-bold">{{ $user->profile->title ?? 'No Title Set' }}</h3>
            </div>

            <div class="pt-2">
                <p class="m-0">{{ $user->profile->description ?? 'No Description Set' }}</p>
            </div>
        </div>
    </div>

    <!-- Tab Navigation for Image and Text Posts -->
    <ul class="nav nav-tabs pt-5" id="postTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="imagePostsTab" data-bs-toggle="tab" href="#imagePosts" role="tab" aria-controls="imagePosts" aria-selected="true">Image Posts</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="textPostsTab" data-bs-toggle="tab" href="#textPosts" role="tab" aria-controls="textPosts" aria-selected="false">Text Posts</a>
        </li>
    </ul>

    <div class="tab-content pt-3" id="postTabsContent">
        <!-- Image Posts Tab -->
        <div class="tab-pane fade show active" id="imagePosts" role="tabpanel" aria-labelledby="imagePostsTab">
            <div class="row">
                @foreach ($user->imagePosts as $post)
                    <div class="col-md-4 mb-4">
                        <a href="/ip/{{ $post->id }}">
                            <img src="/storage/{{ $post->image }}" class="img-fluid w-100 rounded-3">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Text Posts Tab -->
            <div class="tab-pane fade" id="textPosts" role="tabpanel" aria-labelledby="textPostsTab">
                <div class="container">
                    <div class="row justify-content-center">
                        @foreach ($user->textPosts as $post)
                            <div class="col-md-8 mb-4"> <!-- Adjust width here -->
                                <!-- Twitter-like card design -->
                                <div class="card border-0 shadow-sm rounded-3">
                                    <div class="card-body">
                                        <!-- Author Section with Profile Image and Username -->
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $user->profile->profileImage() }}" alt="Profile Image" class="img-fluid rounded-circle" style="max-width: 40px;">
                                            <div class="ms-3">
                                                <h6 class="m-0">{{ $user->username }}</h6>
                                                <small class="text-muted">Posted on {{ $post->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        
                                        <!-- Post Content -->
                                        <p class="card-text">{{ $post->description }}</p>

                                        <!-- Interaction Buttons (like/ comment) -->
                                        <div class="d-flex justify-content-between mt-3">
                                            <button class="btn btn-outline-secondary btn-sm">
                                                <i class="bi bi-heart"></i> Like
                                            </button>
                                            <a href="/tp/{{ $post->id }}" class="btn btn-outline-secondary btn-sm">
                                                <i class="bi bi-chat-left-text"></i> Comment
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
