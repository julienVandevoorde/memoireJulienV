<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Billable;

    /**
     * Les rôles possibles pour un utilisateur.
     */
    const ROLES = ['client', 'tattoo artist', 'admin'];

    /**
     * Les attributs qui sont assignables en masse.
     */
    protected $fillable = [
        'name',
        'login',
        'email',
        'password',
        'role',
        'gender',
        'profile_photo_path',
        'location',
        'bio',
        'instagram_link',
        'experience_years',
    ];

    /**
     * Les attributs qui doivent être cachés pour les tableaux.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être castés à des types natifs.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Vérifie si l'utilisateur est un administrateur.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est un tatoueur.
     */
    public function isTattooArtist()
    {
        return $this->role === 'tattoo artist';
    }

    /**
     * Vérifie si l'utilisateur est un client.
     */
    public function isClient()
    {
        return $this->role === 'client';
    }

    /**
     * Les styles associés à ce tatoueur.
     */
    public function styles()
    {
        return $this->belongsToMany(Style::class, 'style_user', 'user_id', 'style_id');
    }

    /**
     * Les utilisateurs que cet utilisateur suit.
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followed_id');
    }

    /**
     * Les utilisateurs qui suivent cet utilisateur.
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'follower_id');
    }

    /**
     * Vérifie si l'utilisateur suit un autre utilisateur.
     */
    public function isFollowing(User $user)
    {
        return $this->followings()->where('followed_id', $user->id)->exists();
    }

    /**
     * Vérifie si l'utilisateur est suivi par un autre utilisateur.
     */
    public function isFollowedBy(User $user)
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }

    /**
     * Les éléments que cet utilisateur a liké.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Les certifications associées à ce tatoueur.
     */
    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    /**
     * Les portfolios associés à ce tatoueur.
     */
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    /**
     * Les avis reçus en tant que tatoueur.
     */
    public function reviewsAsTattooer()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    /**
     * Les avis donnés en tant que client.
     */
    public function reviewsAsClient()
    {
        return $this->hasMany(Review::class, 'client_id');
    }
}
