<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingRates extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rate_per_km',
        'rate_per_minute',
        'rate_by_car_class'
    ];
}
