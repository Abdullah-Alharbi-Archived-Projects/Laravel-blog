@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            {{ $post->title }}
        </h1>
        <img src="/uploads/{{ $post->img_name }}" alt="{{ $post->title }}" width="80%" class="d-block">
        <small>Published At: {{ $post->created_at }}</small>
        <p>
            {{ $post->content }}
        </p>
    </div>
@endsection('content')
