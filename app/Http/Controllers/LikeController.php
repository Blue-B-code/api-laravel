<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // Like ou Unlike un post
    public function toggle(Post $post)
    {
        $user = Auth::user();

        $like = Like::where('user_id', $user->id)->where('post_id', $post->id)->first();

        if ($like) {
            $like->delete();
            return response()->json(['liked' => false, 'message' => 'Like removed']);
        } else {
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
            return response()->json(['liked' => true, 'message' => 'Post liked']);
        }
    }

    // Nombre de likes + si l'utilisateur a liké
    public function getLikes(Post $post)
    {
        $user = Auth::user();

        return response()->json([
            'likes_count' => $post->likes()->count(),
            'liked' => $post->likes()->where('user_id', $user->id)->exists(),
        ]);
    }
}