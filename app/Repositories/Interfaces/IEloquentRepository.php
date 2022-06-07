<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IEloquentRepository
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    public function find(int $id): ?Model;

    public function update(int $id, array $attributes): void;

    public function all(): Collection;

    public function delete(int $id): void;
}
