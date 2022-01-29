<?php

namespace App\Services\MarketPlace;

use App\Models\Order;

interface MarketPlaceInterface
{
    public function getOrders();

    public function getOrderDetails(Order $order);

    public function updateOrderType(Order $order, array $params = []);
}
