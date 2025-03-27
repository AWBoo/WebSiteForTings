@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6"> <!-- Adjusted column width for responsiveness -->

            <!-- Nav Tabs (Headers) -->
            <ul class="nav nav-tabs" id="postTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="text-tab" data-bs-toggle="tab" href="#textPostForm" role="tab" aria-controls="textPostForm" aria-selected="true">Text Post</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="image-tab" data-bs-toggle="tab" href="#imagePostForm" role="tab" aria-controls="imagePostForm" aria-selected="false">Image Post</a>
                </li>
            </ul>

            <div class="tab-content mt-3">
                <!-- Text Post Form -->
                <div class="tab-pane fade show active" id="textPostForm" role="tabpanel" aria-labelledby="text-tab">
                    <form action="/tp" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row mb-3"><h4>Add New Text Post</h4></div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label">Post Caption</label>
                            <div class="col-md-8">
                                <input 
                                    name="description" 
                                    type="text" 
                                    class="form-control @error('description') is-invalid @enderror" 
                                    value="{{ old('description') }}"  
                                    autocomplete="description" 
                                    autofocus
                                >
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-md-12">
                                <button class="btn btn-primary w-100">Add New Post</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Image Post Form -->
                <div class="tab-pane fade" id="imagePostForm" role="tabpanel" aria-labelledby="image-tab">
                    <form action="/ip" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row mb-3"><h4>Add New Image Post</h4></div>

                        <div class="row mb-3">
                            <label for="caption" class="col-md-4 col-form-label">Post Caption</label>
                            <div class="col-md-8">
                                <input 
                                    name="caption" 
                                    type="text" 
                                    class="form-control @error('caption') is-invalid @enderror" 
                                    value="{{ old('caption') }}"  
                                    autocomplete="caption" 
                                >
                                @error('caption')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label">Post Image</label>
                            <div class="col-md-8">
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-md-12">
                                <button class="btn btn-primary w-100">Add New Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
