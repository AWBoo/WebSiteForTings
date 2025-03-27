@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="m-4 text-center">Explore</h1>

    <!-- Tabs Navigation (Styled like the new selector you provided) -->
    <ul class="nav nav-tabs pt-5" id="postTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="imagePostsTab" data-bs-toggle="tab" href="#imagePosts" role="tab" aria-controls="imagePosts" aria-selected="true" style="color: black;">Image Posts</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="textPostsTab" data-bs-toggle="tab" href="#textPosts" role="tab" aria-controls="textPosts" aria-selected="false" style="color: black;">Text Posts</a>
        </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content pt-3" id="postTabsContent">

        <!-- Image Posts Tab (Instagram-like) -->
        <div class="tab-pane fade show active" id="imagePosts" role="tabpanel" aria-labelledby="imagePostsTab">
            <div class="row row-cols-2 row-cols-md-3 g-0">
                @foreach ($imagePosts as $post)
                    <div class="col mb-0">
                        <div class="position-relative">
                            <a href="/ip/{{ $post->id }}">
                                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Post Image">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Text Posts Tab (Twitter-like) -->
        <div class="tab-pane fade" id="textPosts" role="tabpanel" aria-labelledby="textPostsTab">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($textPosts as $post)
                    <div class="col">
                        <div class="card shadow-sm border-0" style="cursor: pointer;" onclick="window.location.href='/tp/{{ $post->id }}';">
                            <div class="card-body">
                                <!-- User Info Above Post -->
                                <div class="d-flex align-items-center mb-3">
                                    <a href="/profile/{{ $post->user->id }}" class="text-dark fw-bold text-decoration-none">
                                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                    </a>
                                    <span class="text-dark">{{ $post->user->username }}</span> 
                                </div>

                                <!-- Text Post Content -->
                                <a href="/tp/{{ $post->id }}">
                                    <p class="card-text text-muted">{{ $post->description }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </div> <!-- End of Tab Content -->
</div> <!-- End of Container -->

<!-- Custom CSS to override default colors -->
<style>
    .nav-tabs .nav-link {
        color: black; /* Tab label color */
    }

    .nav-tabs .nav-link.active {
        color: black; /* Active tab label color */
    }

    .row-cols-2 .col,
    .row-cols-md-3 .col {
        padding: 0; /* Remove the space between images */
    }
</style>

@endsection
