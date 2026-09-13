<?php

namespace App\Repositories\Eloquent;

use App\Models\File;
use App\Repositories\Interfaces\FileRepositoryInterface;

class FileRepository extends BaseRepository implements FileRepositoryInterface
{
    public function __construct(File $model)
    {
        parent::__construct($model);
    }

    public function findByHash(string $hash): ?File
    {
        return $this->newQuery()->where('hash', $hash)->first();
    }
}