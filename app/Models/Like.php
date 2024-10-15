<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'portfolio_id', // Le like est lié directement à un tatouage (Portfolio)
    ];

    /**
     * Relation avec l'utilisateur qui a liké.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le portfolio (tatouage) liké.
     */
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
