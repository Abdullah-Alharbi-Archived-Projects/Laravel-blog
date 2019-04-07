@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            {{ $post->title }}
        </h1>
        <img src="/uploads/{{ $post->thumbnail_path }}" alt="{{ $post->title }}" width="80%" class="d-block">
        <small>
            <span>Published At: {{ $post->created_at }}</span><br>
            <strong>Author: <a href="/profile/{{ $post->user->id }}">{{ $post->user->name }}</a></strong>
        </small>
        <p>
            {{ $post->content }}
        </p>
    </div>
@endsection('content')
