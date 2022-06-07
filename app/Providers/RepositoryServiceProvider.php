<?php

namespace App\Providers;

use App\Repositories\EloquentRepository\BaseRepository;
use App\Repositories\EloquentRepository\OrderRepository;
use App\Repositories\Interfaces\IEloquentRepository;
use App\Repositories\Interfaces\IOrderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IEloquentRepository::class, BaseRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
