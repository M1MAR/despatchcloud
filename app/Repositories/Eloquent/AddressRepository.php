<?php

namespace App\Repositories\Eloquent;

use App\Models\Address;
use App\Repositories\AddressRepositoryInterface;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    public function __construct(Address $model)
    {
        parent::__construct($model);
    }
}
