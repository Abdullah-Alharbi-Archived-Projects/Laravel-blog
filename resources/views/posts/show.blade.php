@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            {{ $post->title }}
        </h1>
        <small>Published At: {{ $post->created_at }}</small>
        <p>
            {{ $post->content }}
        </p>
    </div>
@endsection('content')
