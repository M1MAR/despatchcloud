<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

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
/*
    public function orderItems()
    {
        return $this->belongsToMany(Product::class);
    }
*/
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
