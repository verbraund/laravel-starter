<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Closure;

abstract class BaseRepository implements BaseRepositoryInterface
{

    public function __construct(
        protected Model $model
    ){}

    public function find(int $id, array $columns = ['*']): ?Model
    {
        return $this->newQuery()->select($columns)->find($id);
    }

    public function findOrFail(int $id, array $columns = ['*']): Model
    {
        return $this->newQuery()->select($columns)->findOrFail($id);
    }

    public function findBy(string $column, mixed $value, array $columns = ['*']): ?Model
    {
        return $this->newQuery()->where($column, $value)->select($columns)->first();
    }

    public function all(array $columns = ['*'], ?Closure $callback = null): Collection
    {
        return $this->applyCallback($callback)
            ->select($columns)
            ->get();
    }

    public function paginate(int $perPage = 20, array $columns = ['*'], ?Closure $callback = null): LengthAwarePaginator
    {
        return $this->applyCallback($callback)
            ->select($columns)
            ->paginate($perPage);
    }

    public function last($length = 1): Collection
    {
        return $this->model->latest()->take($length)->get();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int|Model $model, array $data): Model
    {
        if(!$model instanceof Model){
            $model = $this->findOrFail($model);
        }
        $model->update($data);

        return $model->fresh();
    }

    public function delete(int|Model $model): bool
    {
        if(!$model instanceof Model){
            $model = $this->findOrFail($model);
        }
        return $model->delete();
    }

    public function count(?Closure $callback = null): int
    {
        return $this->applyCallback($callback)->count();
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    protected function newQuery(): Builder
    {
        return $this->getModel()->newQuery();
    }

    protected function applyCallback(?Closure $callback): Builder
    {
        $query = $this->newQuery();

        if ($callback) {
            $callback($query);
        }

        return $query;
    }
}