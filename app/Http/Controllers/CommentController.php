<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return response()->json(['error' => 'Post Not Found'], 404);
        }

        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $validatedData['author'] = Auth::user()->name;
        $validatedData['post_id'] = $postId;

        $comment = Comment::create($validatedData);

        return response()->json($comment, 201);
    }

    public function index($postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return response()->json(['error' => 'Post Not Found'], 404);
        }

        $comments = $post->comments;
        return response()->json($comments);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['error' => 'Comment Not Found'], 404);
        }

        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $validatedData['author'] = Auth::user()->name;

        $comment->update($validatedData);
        return response()->json($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['error' => 'Comment Not Found'], 404);
        }

        $comment->delete();
        return response()->json($comment);
    }
}
