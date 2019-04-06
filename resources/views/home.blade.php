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
                        <h3 class="mb-4">My Posts</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->posts as $post)
                                    <tr>
                                        <td scope="row">{{ $post->title }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="/post/{{ $post->id }}">view</a>
                                            <a class="btn btn-secondary" href="#">edit</a>
                                            <a class="btn btn-danger destroy" href="/post/{{ $post->id }}" data-method="delete">delete</a>
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
