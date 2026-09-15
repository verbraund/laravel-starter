<?php

namespace App\Models\User;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    protected $table = 'user_login_history';

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'is_success',
        'failure_reason',
        'attempted_at'
    ];

    protected function casts()
    {
        return [
            'is_success' => 'boolean',
            'attempted_at' => 'datetime'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
