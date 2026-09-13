<?php

namespace App\Repositories\Eloquent;

use App\Models\Image;
use App\Repositories\Interfaces\ImageRepositoryInterface;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }
}