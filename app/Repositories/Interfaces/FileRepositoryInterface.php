<?php

namespace App\Repositories\Interfaces;

use App\Models\File;

interface FileRepositoryInterface extends BaseRepositoryInterface
{
    public function findByHash(string $hash): ?File;
}