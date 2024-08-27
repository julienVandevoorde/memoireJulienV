<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'tattooer_id',
        'client_id',
    ];

    /**
     * Relation avec le tatoueur.
     */
    public function tattooer()
    {
        return $this->belongsTo(User::class, 'tattooer_id');
    }

    /**
     * Relation avec le client.
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Relation avec les messages associés à ce chat.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
