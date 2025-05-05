<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $guarded = [];


    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function cabin(): BelongsTo
    {
        return $this->belongsTo(Cabin::class);
    }
}
