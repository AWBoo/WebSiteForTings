@extends('layouts.app')

@section('content')
<div id="app">
  <tabs :image-posts="{{ json_encode($imagePosts) }}" :text-posts="{{ json_encode($textPosts) }}"></tabs>
</div>
@endsection
