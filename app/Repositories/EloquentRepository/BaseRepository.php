<?php

namespace App\Repositories\EloquentRepository;

use App\Repositories\Interfaces\IEloquentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements IEloquentRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->model->destroy($id);
    }

    public function update(int $id, array $attributes): void
    {
        $this->model->where('id', '=', $id)->update($attributes);
    }
}
