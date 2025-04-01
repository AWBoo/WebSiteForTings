@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Text Post Section -->
        <div class="col-lg-8 col-md-12 mb-4">
            <div class="border p-4 rounded shadow-sm bg-light">
                <!-- Post Description -->
                <p class="mb-0" style="font-size: 1.2rem; line-height: 1.6; color: #333;">{{ $post->description }}</p>
            </div>
        </div>

        <!-- User Profile & Post Information -->
        <div class="col-lg-4 col-md-12">
            <div class="d-flex align-items-center mb-3">
                <div class="me-2">
                    <a href="/profile/{{ $post->user->id }}" class="text-dark fw-bold text-decoration-none">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
                    </a>
                </div>
                <div class="d-flex align-items-center">
                    <div class="font-weight-bold h5 mb-0">{{ $post->user->username }}</div>
                </div>
                <div class="ms-auto">
                    <follow-button user-id="{{ $post->user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
            </div>

            <!-- Interaction Buttons -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    <!-- Like Button Component -->
                    <like-button 
                        :post-id="{{ $post->id }}" 
                        :post-type="'tp'" 
                        :initial-liked="{{ auth()->user()->hasLiked($post) ? 'true' : 'false' }}" 
                        :initial-like-count="{{ $post->likeCount() }}">
                    </like-button>
                    <button class="btn btn-light btn-sm">Share</button>
                </div>
                <div class="text-muted small">
                    <i class="bi bi-clock"></i> {{ $post->created_at->diffForHumans() }}
                </div>
            </div>

            <!-- Comment Section -->
            <hr>
            <div class="d-flex align-items-center mb-3">
                <!-- Comment Input and Submit Button in the same line -->
                <form action="{{ route('comments.store', ['postType' => $post->getMorphClass(), 'postId' => $post->id]) }}" method="POST" class="d-flex align-items-center w-100">
                    @csrf
                    <!-- Profile Image -->
                    <img src="{{ auth()->user()->profile->profileImage() }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px;">
                    
                    <!-- Textarea -->
                    <textarea name="comment" class="form-control" placeholder="Write a comment... (Max 250 char)" style="resize: none; height: 40px; width: 100%;"></textarea>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary ms-2" style="width: 80px;">Submit</button>
                </form>
            </div>
            <hr>

            <!-- Display Comments Section -->
            <div class="comments-section">
                @if($post->comments->isNotEmpty())
                    @foreach ($post->comments as $comment)
                        <div class="d-flex align-items-start mb-3">
                            <img src="{{ $comment->user->profile->profileImage() ?? 'default-avatar.jpg' }}" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
                            <div class="ms-3 w-100">
                                <div class="d-flex justify-content-between">
                                    <div class="font-weight-bold">{{ $comment->user->username }}</div>
                                    <div class="text-muted small">{{ $comment->created_at->diffForHumans() }}</div>
                                </div>
                                <p class="mb-0">{{ $comment->content }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No comments yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
