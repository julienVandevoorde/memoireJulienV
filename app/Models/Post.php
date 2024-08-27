<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    /**
     * Relation avec l'utilisateur (tatoueur).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Les likes associés à ce post.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Vérifie si l'utilisateur a liké ce post.
     */
    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
