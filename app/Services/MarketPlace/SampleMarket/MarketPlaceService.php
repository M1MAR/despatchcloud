<?php

namespace App\Services\MarketPlace\SampleMarket;

use App\Models\Order;
use App\Services\MarketPlace\MarketPlaceInterface;

class MarketPlaceService extends BaseService implements MarketPlaceInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getOrders(array $params = [])
    {
        return $this->get('orders', $params);
    }

    public function getOrderDetails(Order $order)
    {
        return $this->get('orders/' . $order->id);
    }

    public function updateOrderType(Order $order, array $params = [])
    {
        return $this->post('orders/' . $order->id, $params);
    }
}
