<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'reported_user_id',
        'reporting_user_id',
        'reason',
    ];

    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }

    public function reportingUser()
    {
        return $this->belongsTo(User::class, 'reporting_user_id');
    }
}
