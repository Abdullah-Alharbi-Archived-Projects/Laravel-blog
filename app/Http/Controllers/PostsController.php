<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public function create()
    {
        return Auth::check() ? view("posts.create") : redirect("login");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('auth');
        $attributes = request(["title", "content"]);

        Post::create([
            "user_id" => $request->user()->id,
            "title" => $attributes["title"],
            "content" => $attributes["content"]
        ]);

        return redirect("/");
    }

    public function show(Post $post)
    {
        return view("posts.show", compact("post"));
    }


    public function edit(Post $post)
    {
        return Auth::check() ? view("posts.edit", compact("post")) : redirect("login");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->middleware('auth');
        $attributes = request(["title", "content"]);
        $post->title = $attributes["title"];
        $post->content = $attributes["content"];
        $post->save();
        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->middleware('auth');
        $post->delete();
        return "Done !";
    }
}
