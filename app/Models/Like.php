<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    /**
     * Relation avec l'utilisateur qui a liké.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le contenu liké (post, portfolio, etc.).
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
