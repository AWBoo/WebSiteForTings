@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="tabs-container">
        <ul class="nav nav-tabs justify-content-center" id="postTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="image-tab" data-bs-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="true">Image Posts</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="text-tab" data-bs-toggle="tab" href="#text" role="tab" aria-controls="text" aria-selected="false">Text Posts</a>
            </li>
        </ul>

        <div class="tab-content mt-4" id="postTabsContent">
            @if($imagePosts->isEmpty() && $textPosts->isEmpty())
                <div class="no-posts text-center mt-5">
                    <h4>You don't seem to follow anyone</h4>
                    <p><a href="/explore" class="btn btn-primary">Explore</a></p>
                </div>
            @else
                <div class="tab-pane fade show active" id="image" role="tabpanel" aria-labelledby="image-tab">
                    <div class="row justify-content-center">
                        @foreach($imagePosts as $post)
                            <div class="col-md-6 mb-4">
                                <div class="post-card image-card border rounded shadow-sm">
                                    <div class="post-header p-3 d-flex align-items-center">
                                        <a href="/profile/{{ $post->user->id }}">
                                            <img src="{{ asset($post->user->profile->profileImage()) }}" alt="Avatar" class="avatar rounded-circle" width="40" height="40">
                                        </a>
                                        <h5 class="username ms-2 mb-0">{{ $post->user->username }}</h5>
                                    </div>
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="post-image w-100" style="object-fit: cover; height: auto;">
                                    <div class="post-caption p-3">
                                        <p>{{ $post->caption }}</p>
                                    </div>
                                    <div class="post-actions p-3 d-flex justify-content-between">
                                        <!-- Like Button Component -->
                                        <like-button 
                                            :post-id="{{ $post->id }}" 
                                            :post-type="'ip'" 
                                            :initial-liked="{{ auth()->user()->hasLiked($post) ? 'true' : 'false' }}" 
                                            :initial-like-count="{{ $post->likeCount() }}">
                                        </like-button>
                                        <button class="action-btn share-btn btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-share"></i> Shares
                                        </button>
                                        <button class="action-btn comment-btn btn btn-outline-success btn-sm">
                                            <a href="/ip/{{ $post->id }}" class="text-decoration-none text-success">
                                                <i class="fas fa-comment"></i> Comments
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="text" role="tabpanel" aria-labelledby="text-tab">
                    <div class="row justify-content-center">
                        @foreach($textPosts as $post)
                            <div class="col-md-6 mb-4">
                                <div class="post-card text-card border rounded shadow-sm">
                                    <div class="post-header p-3 d-flex align-items-center">
                                        <a href="/profile/{{ $post->user->id }}">
                                            <img src="{{ asset($post->user->profile->profileImage()) }}" alt="Avatar" class="avatar rounded-circle" width="40" height="40">
                                        </a>
                                        <h5 class="username ms-2 mb-0">{{ $post->user->username }}</h5>
                                    </div>
                                    <div class="post-content p-3">
                                        <p>{{ $post->description }}</p>
                                    </div>
                                    <div class="post-actions p-3 d-flex justify-content-between">
                                        <!-- Like Button Component -->
                                        <like-button 
                                            :post-id="{{ $post->id }}" 
                                            :post-type="'tp'" 
                                            :initial-liked="{{ auth()->user()->hasLiked($post) ? 'true' : 'false' }}" 
                                            :initial-like-count="{{ $post->likeCount() }}">
                                        </like-button>
                                        <button class="action-btn share-btn btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-share"></i> Shares
                                        </button>
                                        <button class="action-btn comment-btn btn btn-outline-success btn-sm">
                                            <a href="/tp/{{ $post->id }}" class="text-decoration-none text-success">
                                                <i class="fas fa-comment"></i> Comments
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

