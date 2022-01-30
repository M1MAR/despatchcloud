<?php

namespace App\Traits;

use Carbon\Carbon;

trait SetTimeZoneVariables
{
    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] =  Carbon::parse($value);
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] =  Carbon::parse($value);
    }
}
