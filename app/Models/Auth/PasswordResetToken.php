<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PasswordResetToken extends Model
{

    protected $fillable = [
        'user_id',
        'token_hash',
        'expires_at',
    ];

    protected function casts()
    {
        return [
            'expires_at' => 'datetime'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
