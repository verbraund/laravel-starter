<?php

namespace App\Repositories\Interfaces\User;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface LoginHistoryRepositoryInterface extends BaseRepositoryInterface
{
    public function findManyByUserId(int $userId): Collection;
}