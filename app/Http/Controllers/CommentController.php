<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function commentList()
    {
        $comments = CommentResource::collection(Comment::with('user', 'replies')->get());

        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        Comment::create([
            'body' => $request->input('body'),
            'user_id' => Auth::id(),
            'post_id' => $request->input('post_id')
        ]);

        return redirect()->route('post.index');
    }
}
