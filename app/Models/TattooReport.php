<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TattooReport extends Model
{
    use HasFactory;

    protected $fillable = ['portfolio_id', 'user_id', 'reason'];

    // Relation avec Portfolio (tatouage)
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

    // Relation avec User (qui a signalé)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
