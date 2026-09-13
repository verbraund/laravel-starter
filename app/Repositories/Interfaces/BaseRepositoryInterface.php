<?php

namespace App\Repositories\Interfaces;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
    public function find(int $id, array $columns = ['*']): ?Model;

    public function findOrFail(int $id, array $columns = ['*']): Model;

    public function findBy(string $column, mixed $value, array $columns = ['*']): ?Model;

    public function all(array $columns = ['*'], ?Closure $callback = null): Collection;

    public function paginate(int $perPage = 20, array $columns = ['*'], ?Closure $callback = null): LengthAwarePaginator;

    public function last($length = 1): Collection;

    public function create(array $data): Model;

    public function update(int|Model $model, array $data): Model;

    public function delete(int|Model $model): bool;

    public function count(?Closure $callback = null): int;

    public function getModel(): Model;

}