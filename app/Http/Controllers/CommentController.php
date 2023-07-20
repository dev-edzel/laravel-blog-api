<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
{
    // Validate data
    $data = $request->validate([
        'content' => 'required'
    ]);

    $post = Post::findOrFail($id);
    $comment = new Comment($data);
    $comment->user_id = auth()->id();
    $post->comments()->save($comment);

    return response()->json($comment, 201);
}

public function index($id)
{
    $post = Post::findOrFail($id);
    return response()->json($post->comments);
}

public function update(Request $request, $id)
{
    // Validate data
    $data = $request->validate([
        'content' => 'required'
    ]);

    $comment = Comment::findOrFail($id);

    // Ensure the user updating the comment is the author
    if ($comment->user_id !== auth()->id()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $comment->update($data);
    return response()->json($comment);
}

public function destroy($id)
{
    $comment = Comment::findOrFail($id);

    // Ensure the user deleting the comment is the author
    if ($comment->user_id !== auth()->id()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $comment->delete();
    return response()->json(null, 204);
}
}

