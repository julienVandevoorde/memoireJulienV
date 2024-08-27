<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'rating',
        'comment',
    ];

    /**
     * Relation avec le tatoueur.
     */
    public function tattooer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation avec le client.
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
