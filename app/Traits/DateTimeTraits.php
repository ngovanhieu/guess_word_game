<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateTimeTraits
{
    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format(config('dateformat.' . get_class($this)));
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->format(config('dateformat.' . get_class($this)));
    }
}
