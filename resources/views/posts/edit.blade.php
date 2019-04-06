@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Post</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="/posts/{{ $post->id }}" method="post">
                            @csrf
                            @method("PATCH")

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text"
                                    class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Title"
                                value="{{ $post->title }}">
                            </div>
                            <div class="form-group">
                              <label for="content">Content</label>
                              <textarea class="form-control" name="content" id="content" rows="3" placeholder="Content">
                                    {{ $post->content }}
                              </textarea>
                            </div>

                            <div class="form-group">
                                <img src="/uploads/{{ $post->thumbnail_path }}" alt="{{ $post->id }}" class="w-50 d-block">
                                <label for="thumbnail">Upload Thumbnail</label>
                                <input type="file" class="form-control-file" name="thumbnail" id="thumbnail" placeholder="choose thumbnail">
                            </div>

                            <button type="submit" class="btn btn-warning btn-lg btn-block">Save</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
