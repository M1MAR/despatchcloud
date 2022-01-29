<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_product';

    public $timestamps = false;

    protected $guarded = [];

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] =  Carbon::parse($value);
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] =  Carbon::parse($value);
    }
}
