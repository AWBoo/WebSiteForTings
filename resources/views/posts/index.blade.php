@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Left Side: Instagram-Style Image Feed -->
        <div class="col-md-7"> 
            @foreach ($posts as $post)
                <div class="card mb-3 shadow-sm border-0">
                    <!-- User Info -->
                    <div class="card-header bg-white border-bottom d-flex align-items-center p-2">
                        <a href="/profile/{{ $post->user->id }}" class="text-dark fw-bold text-decoration-none">
                            <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle me-2" style="width: 35px; height: 35px;">
                        </a>
                        {{ $post->user->username }}
                    </div>

                    <!-- Post Image -->
                    <div class="card-body p-0">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#postModal{{ $post->id }}">
                            <img src="/storage/{{ $post->image }}" alt="Post Image" class="img-fluid w-100">
                        </a>    
                    </div>

                    <!-- Post Caption -->
                    <div class="card-footer bg-white p-2">
                        <p class="m-0">{{ $post->caption }}</p>
                    </div>
                </div>

                <!-- Modal for Post Detail -->
                <div class="modal fade" id="postModal{{ $post->id }}" tabindex="-1" aria-labelledby="postModalLabel{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">

                            <!-- Modal Body (User Info and Post Details) -->
                            <div class="modal-body p-4">
                                <!-- User Info (Profile Picture and Username) -->
                                <div class="d-flex align-items-center mb-3">
                                    <a href="/profile/{{ $post->user->id }}" class="text-dark fw-bold text-decoration-none">
                                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                                    </a>
                                    <a href="/profile/{{ $post->user->id }}" class="text-dark fw-bold text-decoration-none">
                                        {{ $post->user->username }}
                                    </a>
                                </div>

                                <!-- Post Image -->
                                <div class="mb-3">
                                    <a href="/ip/{{ $post->id }}">
                                        <img src="/storage/{{ $post->image }}" alt="Post Image" class="img-fluid w-100" style="object-fit: cover; max-height: 400px;">
                                    </a>
                                </div>

                                <!-- Post Caption -->
                                <div class="mb-3">
                                    <p class="m-0">{{ $post->caption }}</p>
                                </div>

                                <!-- Modal Footer (Optional: Add interaction buttons like like, comment, etc.) -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-light btn-sm">Like</button>
                                    <button class="btn btn-light btn-sm">Comment</button>
                                    <button class="btn btn-light btn-sm">Share</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Right Side: Space for Tweets -->
        <div class="col-md-5">
            <div class="p-3">
                <h5 class="fw-bold">Tweets Section</h5>
                <p class="text-muted">This is where the tweets will go.</p>
            </div>
        </div>
    </div>
</div>
@endsection
