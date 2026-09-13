<?php

namespace App\Repositories\Eloquent\User;

use App\Models\User\User;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\User\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->newQuery()->where('email', $email)->first();
    }
}