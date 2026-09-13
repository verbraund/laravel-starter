<?php

namespace App\Models\User;

use App\Models\Auth\RefreshToken;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class RequestStatistic extends Model
{
    protected $table = 'user_request_statistics';

    protected $fillable = [
        'method',
        'url',
        'response_status',
    ];

    public function refresh_token()
    {
        return $this->belongsTo(RefreshToken::class,'refresh_token_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
