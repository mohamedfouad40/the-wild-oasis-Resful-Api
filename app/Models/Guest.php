<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    use HasApiTokens;

    
    protected $guarded=[];





    public function bookings(): HasMany

    {
        return $this->hasMany(Booking::class);
    }
}
