<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'model',
        'make',
        'year',
        'plate_number',
        'color',
        'seats',
        'fuel_type',
        'engine_size',
        'status',
        'created_by',
    ];

    protected $hidden = [
        'driver_id',
        'id',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}