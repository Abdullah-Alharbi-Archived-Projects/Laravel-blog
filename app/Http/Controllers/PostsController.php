<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public function create()
    {
        return Auth::check() ? view("create_post") : redirect("login");
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
        return view("show_post", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->middleware('auth');
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
