<?php

namespace App\Repositories\Interfaces;

use App\Models\Dictionary;

interface DictionaryRepositoryInterface extends BaseRepositoryInterface
{
    public function findByKey(string $key): ?Dictionary;
}