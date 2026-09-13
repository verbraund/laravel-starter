<?php

namespace App\Repositories\Eloquent\User;

use App\Models\User\LoginHistory;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\User\LoginHistoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LoginHistoryRepository extends BaseRepository implements LoginHistoryRepositoryInterface
{
    public function __construct(LoginHistory $model)
    {
        parent::__construct($model);
    }

    public function findManyByUserId(int $userId): Collection
    {
        return $this->newQuery()->where('user_id', $userId)->get();
    }
}