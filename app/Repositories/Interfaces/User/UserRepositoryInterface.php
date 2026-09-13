<?php

namespace App\Repositories\Interfaces\User;

use App\Models\User\User;
use App\Repositories\Interfaces\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}