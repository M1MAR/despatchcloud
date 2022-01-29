<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\AddressRepositoryInterface;
use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Services\MarketPlace\MainMarketPlaceService;
use Illuminate\Support\Collection;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;
    /**
     * @var AddressRepositoryInterface
     */
    private $addressRepository;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var MainMarketPlaceService
     */
    private $mainMarketPlaceService;

    public function __construct(
        Order $model,
        CustomerRepositoryInterface $customerRepository,
        AddressRepositoryInterface $addressRepository,
        ProductRepositoryInterface $productRepository,
        MainMarketPlaceService $mainMarketPlaceService
    )
    {
        parent::__construct($model);
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        $this->productRepository = $productRepository;
        $this->mainMarketPlaceService = $mainMarketPlaceService;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function get(int $limit): Collection
    {
        return $this->model
            ->select(["id", "type"])
            ->where(function ($query) {
                $query->whereNull("customer_id")
                    ->orWhereNull("billing_address_id")
                    ->orWhereNull("shipping_address_id");
            })
            ->orderByDesc('id')
            ->limit($limit)
            ->get("id", "type");
    }

    public function firstOrCreate($collection = [])
    {
        $order = $this->find($collection['id']);

        $customer = $this->customerRepository->create($collection['customer']);
        $order->customer()->associate($customer);

        $billing_address = $this->addressRepository->create($collection['billing_address']);
        $order->billing_address()->associate($billing_address);

        $shipping_address = $this->addressRepository->create($collection['shipping_address']);
        $order->shipping_address()->associate($shipping_address);

        foreach ($collection['order_items'] as $order_item){
            $this->productRepository->firstOrCreate($order_item);
        }

        $order->save();
    }

    public function max(string $value): int
    {
        return $this->model->max($value) ? $this->model->max($value) : 1;
    }

    public function approveOrderType(Order $order)
    {
        if($order->has_approved()){
            return;
        }

        do {
            $res = $this->mainMarketPlaceService->updateOrderType($order, ["type" => "approved"]);
        } while (!$res);

        $order->update([
            'type' => "approved"
        ]);
    }
}
