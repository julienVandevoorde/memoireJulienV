<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image_path',
    ];

    /**
     * Relation avec l'utilisateur (tatoueur).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les likes.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Vérifie si l'utilisateur a liké ce portfolio.
     */
    public function isLikedBy(?User $user)
    {
        if (!$user) {
            return false; // Si l'utilisateur n'est pas connecté
        }
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
