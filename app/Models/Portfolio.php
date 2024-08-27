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
     * Les likes associés à ce portfolio.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Vérifie si l'utilisateur a liké ce portfolio.
     */
    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
