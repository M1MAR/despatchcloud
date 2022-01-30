<?php

namespace App\Models;

use App\Traits\SetTimeZoneVariables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, SetTimeZoneVariables;

    public $timestamps = false;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['quantity', "subtotal"]);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function billing_address()
    {
        return $this->belongsTo(Address::class);
    }

    public function shipping_address()
    {
        return $this->belongsTo(Address::class);
    }

    public function has_approved()
    {
        return $this->type === "approved";
    }
}
