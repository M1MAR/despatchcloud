<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function all(): Collection;

    public function firstOrCreate($collection = []);

    public function max(string $value): int;

    public function get(int $limit): Collection;

    public function approveOrderType(Order $order);
}
