@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="row justify-content-center">
        <div class="col-8 offest-2">
            <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
                
                @csrf
                @method('PATCH')

                <div class="row"><h1>Edit Profile Page</h1></div>

                <div class="row">
                    <label for="title" class="col-md-4 col-form-label">Title</label>
                    <input 
                        name="title" 
                        type="text" 
                        class="form-control @error('title') is-invalid @enderror" 
                        value="{{ old('description', $user->profile->title ?? '') }}"
                        autocomplete="title" 
                        autofocus
                    >

                    @error('title')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="row">
                    <label for="description" class="col-md-4 col-form-label">Description</label>
                    <input 
                        name="description" 
                        type="text" 
                        class="form-control @error('description') is-invalid @enderror" 
                        value="{{ old('description', $user->profile->description ?? '') }}"
                        autocomplete="description" 
                        autofocus
                    >

                    @error('description')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Profile Image</label>
                    <input type="file" class="'form-control-file" id="image" name="image">

                    @error('image')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
