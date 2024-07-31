<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelPayments extends Model
{
    use HasFactory;

    protected $fillable = [
        'fuel_id',
        'payment_id',
        'receipt',
        'amount',
    ];
}
