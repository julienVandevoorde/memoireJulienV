<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'image_path'];

    /**
     * Relation avec l'utilisateur (tatoueur).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
