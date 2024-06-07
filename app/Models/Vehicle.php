<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'organisation_id',
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
        'organisation_id',
        'id',
        'created_by',
        'created_at',
        'updated_at',
    ];
    
    public function driver() {
        return $this->belongsTo(Driver::class);
    }

    public function organisation() {
        return $this->belongsTo(Organisation::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function services()
    {
        return $this->hasMany(VehicleService::class);
    }
}