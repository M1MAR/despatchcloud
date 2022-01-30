<?php

namespace App\Models;

use App\Traits\SetTimeZoneVariables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, SetTimeZoneVariables;

    public $timestamps = false;

    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
