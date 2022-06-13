<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }

    public function postList()
    {
        $posts = PostResource::collection(Post::with('user')->get());

        return response()->json($posts);
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('post.index');
    }


    public function edit($id)
    {
        $post = new PostResource(Post::find($id));

        return response()->json($post);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = Post::findOrFail($id);

        $post->update($request->all());

        return redirect()->route('post.index');
    }

    public function delete($id) {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route('post.index');
    }
}
