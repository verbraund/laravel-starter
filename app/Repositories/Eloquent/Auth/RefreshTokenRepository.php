<?php

namespace App\Repositories\Eloquent\Auth;

use App\Models\Auth\RefreshToken;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Auth\RefreshTokenRepositoryInterface;

class RefreshTokenRepository extends BaseRepository implements RefreshTokenRepositoryInterface
{
    public function __construct(RefreshToken $model)
    {
        parent::__construct($model);
    }
}