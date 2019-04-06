@extends('layouts.app')

@section('content')
    <div class="container">
        <ul style="list-style: none;">
            @foreach ($posts as $post)
                <li class="mb-4">
                    <a href="/posts/{{ $post->id }}">
                        <img src="/uploads/{{ $post->thumbnail_path }}" class="w-25 d-block" alt="{{ $post->title }}">
                        {{ $post->title }} - {{ $post->user->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection('content')
