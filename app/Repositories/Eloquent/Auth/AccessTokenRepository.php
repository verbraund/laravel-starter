<?php

namespace App\Repositories\Eloquent\Auth;

use App\Models\Auth\AccessToken;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Auth\AccessTokenRepositoryInterface;

class AccessTokenRepository extends BaseRepository implements AccessTokenRepositoryInterface
{
    public function __construct(AccessToken $model)
    {
        parent::__construct($model);
    }
}