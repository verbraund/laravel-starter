<?php

namespace App\Repositories\Eloquent;

use App\Models\Dictionary;
use App\Repositories\Interfaces\DictionaryRepositoryInterface;

class DictionaryRepository extends BaseRepository implements DictionaryRepositoryInterface
{

    public function __construct(Dictionary $model)
    {
        parent::__construct($model);
    }

    public function findByKey(string $key): ?Dictionary
    {
        return $this->newQuery()->where('key', $key)->first();
    }
}