<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'password_expired_at',
        'email_verified_at',
        'mfa_enabled',
        'mfa_secret',
        'last_login_at',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'tfa_secret'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'password_expired_at' => 'datetime',
            'is_active' => 'boolean',
            'mfa_enabled' => 'boolean',
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
        ];
    }
}
