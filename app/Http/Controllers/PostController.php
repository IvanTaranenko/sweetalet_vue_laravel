<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return response()->json($posts);
    }
    public function destroy(Post $post)
    {
        try {
            $post->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete the post.',
                'error' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'message' => 'Post deleted successfully!',
        ]);
    }
}
