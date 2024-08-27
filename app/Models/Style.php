<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     */
    protected $fillable = ['name'];

    /**
     * Les utilisateurs (tatoueurs) associés à ce style.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'style_user', 'style_id', 'user_id');
    }
}
