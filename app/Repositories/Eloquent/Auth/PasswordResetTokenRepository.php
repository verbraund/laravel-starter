<?php

namespace App\Repositories\Eloquent\Auth;

use App\Models\Auth\PasswordResetToken;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Auth\PasswordResetTokenRepositoryInterface;

class PasswordResetTokenRepository extends BaseRepository implements PasswordResetTokenRepositoryInterface
{
    public function __construct(PasswordResetToken $model)
    {
        parent::__construct($model);
    }
}