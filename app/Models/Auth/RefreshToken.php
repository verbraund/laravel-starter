<?php

namespace App\Models\Auth;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefreshToken extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'token',
        'user_agent',
        'ip_address',
        'expiration_in',
    ];

    protected function casts()
    {
        return [
            'expiration_in' => 'datetime'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
