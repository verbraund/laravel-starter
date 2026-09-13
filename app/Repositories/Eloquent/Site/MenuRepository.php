<?php

namespace App\Repositories\Eloquent\Site;

use App\Models\Site\Menu;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Site\MenuRepositoryInterface;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    public function __construct(Menu $model)
    {
        parent::__construct($model);
    }
}