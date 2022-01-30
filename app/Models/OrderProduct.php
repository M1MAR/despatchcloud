<?php

namespace App\Models;

use App\Traits\SetTimeZoneVariables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory, SetTimeZoneVariables;

    protected $table = 'order_product';

    public $timestamps = false;

    protected $guarded = [];
}
