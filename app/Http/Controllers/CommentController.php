<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $post = Post::find($postId);
        if(!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = auth()->id();
        $post->comments()->save($comment);

        return response()->json($comment);
    }

    public function show($postId)
    {
        $post = Post::find($postId);
        if(!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        return response()->json($post->comments);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        if(!$comment || $comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Comment not found or not authorized'], 403);
        }

        $comment->content = $request->input('content');
        $comment->save();

        return response()->json($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if(!$comment || $comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Comment not found or not authorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }
}

