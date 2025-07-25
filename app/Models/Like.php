<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // Relation vers l'utilisateur qui a liké
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation vers le post liké
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}