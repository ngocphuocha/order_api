<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface IUserRepository
{
    public function all(): Collection;
}
