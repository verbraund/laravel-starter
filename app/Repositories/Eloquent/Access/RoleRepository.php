<?php

namespace App\Repositories\Eloquent\Access;

use App\Models\Access\Role;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Access\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}