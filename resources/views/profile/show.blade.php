@extends('layouts.app')

@section('custom_style')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1 class="text-uppercase">{{ $profile->user->name }}</h1>
        <img src="/assets/{{ $profile->wallpaper_path }}" alt="{{ $profile->user->name }}_wallpaper" class="rounded profile_wallpaper">
        <hr>
        <nav class="nav justify-content-left mb-5">
          <a class="nav-link active" href="#">Posts ({{ $profile->user->posts->count() }})</a>
          @auth
            <a class="nav-link" href="#">Settings</a>  
          @endauth
        </nav>

        <div class="row">
            @foreach ($profile->user->posts as $post)
                <div class="col-md-4">
                    <div class="card">
                        <a href="/posts/{{ $post->id }}">
                            <img class="card-img-top" src="/uploads/{{ $post->thumbnail_path }}" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                            </div>
                        </a>
                        @auth
                            <div class="card-footer">
                                <a class="btn btn-secondary btn-lg" href="/posts/{{ $post->id }}/edit">Edit</a>
                                <a class="btn btn-danger btn-lg destroy float-right" href="/posts/{{ $post->id }}" data-method="delete">Delete</a>
                            </div>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection('content')
