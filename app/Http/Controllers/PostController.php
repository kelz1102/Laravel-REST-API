<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderByDesc('id')->get();
        return response()->json([
            'status' => 'success',
            'posts' => $posts,
        ]);
    }

    public function store(PostRequest $request)
    {
       $data = $request->validated();
       $data['user_id'] = auth()->user()->id;
       Post::create($data);
       return response()->json([
            'status' => 'success',
            'message' => 'Post created successfully',
        ]);
    }

    public function update(PostRequest $request, $id)
    {
       
        $post = Post::find($id);
        $post->update($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'Post updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Post deleted successfully',
            'post' => $post,
        ]);
    }
}
