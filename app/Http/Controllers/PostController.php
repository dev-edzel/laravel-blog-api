<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AuthControlller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            // 'author' => 'required|string',
        ]);

        $validatedData['author'] = Auth::user()->name;

        $post = Post::create($validatedData);
        return response()->json($post, 201);
    }                                                                            

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Not Found'], 404);
        }


        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Invalid'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $validatedData['author'] = Auth::user()->name;

        $post->update($validatedData);
        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Invalid'], 404);
        }

        $post->delete();
        return response()->json($post);
    }
}
