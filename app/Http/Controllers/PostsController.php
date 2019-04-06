<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $this->validate($request, [
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if($request->hasFile("thumbnail")) {
            $image = $request->file("thumbnail");
            $path = Storage::disk('uploads')->put('thumbnails', $image);
            $attributes = request(["title", "content"]);
    
            Post::create([
                "user_id" => $request->user()->id,
                "title" => $attributes["title"],
                "content" => $attributes["content"],
                "thumbnail_path" => $path
            ]);
    
            return redirect("/");
        }
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
        $this->validate($request, [
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if($request->hasFile("thumbnail")) {
            Storage::disk('uploads')->delete($post->thumbnail_path);
            $image = $request->file("thumbnail");
            $path = Storage::disk('uploads')->put('thumbnails', $image);
            $attributes = request(["title", "content"]);
            $post->title = $attributes["title"];
            $post->content = $attributes["content"];
            $post->thumbnail_path = $path;
            $post->save();
            return redirect("/");
        }
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
        Storage::disk('uploads')->delete($post->img_name);
        $post->delete();
        return "Done !";
    }
}
