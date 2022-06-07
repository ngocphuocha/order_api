<?php

namespace App\Repositories\EloquentRepository;

use App\Models\Order;
use App\Repositories\Interfaces\IOrderRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class OrderRepository extends BaseRepository implements IOrderRepository
{


    /**
     * UserRepository constructor.
     *
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }
}
