<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'post_id',
    ];

    // Relation vers l'utilisateur qui a commenté
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation vers le post commenté
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}