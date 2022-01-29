<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function firstOrCreate($collection = []);
}
