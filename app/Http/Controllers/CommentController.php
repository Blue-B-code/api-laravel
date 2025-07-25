<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Ajouter un commentaire
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        // Charger l'auteur du commentaire pour le renvoyer au frontend
        $comment->load('user');

        return response()->json($comment, 201);
    }

    // Récupérer les commentaires d’un post
    public function index(Post $post)
    {
        $comments = $post->comments()->with('user')->orderBy('created_at', 'asc')->get();
        return response()->json($comments);
    }
}