<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\Admin\Menu;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\MenuRepositoryInterface;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    public function __construct(Menu $model)
    {
        parent::__construct($model);
    }
}