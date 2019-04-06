@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <h3>My Posts</h3>
                        <div class="clearfix mb-4">
                            <a class="btn btn-success float-right" href="/posts/create">
                                Create new post
                            </a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>thumbnail</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->posts as $post)
                                    <tr>
                                        <td scope="row" class="w-25">
                                            <a href="/posts/{{ $post->id }}">
                                                <img src="/uploads/{{ $post->thumbnail_path }}" alt="{{ $post->id }}" class="w-100 img-thumbnail border-primary">
                                            </a>
                                        </td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="/posts/{{ $post->id }}">View</a>
                                            <a class="btn btn-secondary" href="/posts/{{ $post->id }}/edit">Edit</a>
                                            <a class="btn btn-danger destroy" href="/posts/{{ $post->id }}" data-method="delete">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('js')
    <script>
            $("a.destroy").click(function(e) {
                e.preventDefault();
                var confirmBool = confirm("Are you sure to delete this item?");
                if(!confirmBool) {
                    return window.location.href = window.location.href;
                }
                var $this = $(this);
                $.ajax({
                    type: $this.data('method'),
                    url: $this.attr('href'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).done(function (data) {
                    alert('success');
                    $this.parent().parent().remove();
                });
            });
    </script>
@endsection
