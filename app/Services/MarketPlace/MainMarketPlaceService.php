<?php

namespace App\Services\MarketPlace;

use App\Models\Order;
use App\Services\MarketPlace\SampleMarket\MarketPlaceService;

class MainMarketPlaceService extends MarketPlaceService
{
    public function getOrders(array $params = [])
    {
        return parent::getOrders($params);
    }

    public function getOrderDetails(Order $order)
    {
        return parent::getOrderDetails($order);
    }

    public function updateOrderType(Order $order, array $params = [])
    {
        return parent::updateOrderType($order, $params);
    }
}
