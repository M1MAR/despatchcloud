<?php

namespace App\Repositories\Eloquent;

use App\Models\OrderProduct;
use App\Repositories\OrderProductRepositoryInterface;

class OrderProductRepository extends BaseRepository implements OrderProductRepositoryInterface
{
    public function __construct(OrderProduct $model)
    {
        parent::__construct($model);
    }
}
