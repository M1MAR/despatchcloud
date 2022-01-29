<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\OrderProductRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * @var OrderProductRepositoryInterface
     */
    private $orderProductRepository;

    public function __construct(Product $model, OrderProductRepositoryInterface $orderProductRepository)
    {
        parent::__construct($model);
        $this->orderProductRepository = $orderProductRepository;
    }

    public function firstOrCreate($collection = [])
    {
        $this->create($collection['product']);
        $this->orderProductRepository->create(
            collect($collection)
                ->only(["id","order_id","product_id","quantity","subtotal","created_at","updated_at"])
                ->toArray()
        );
    }
}
