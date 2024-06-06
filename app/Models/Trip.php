<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'customer_id',
        'customer_organisation_code',
        'customer_contact',
        'home_address',
        'vehicle_id',
        'vehicle_class',
        'driver_id',
        'vehicle_license_plate',
        'preferred_route',
        'pick_up_time',
        'drop_off_or_pick_up_date',
        'pick_up_location',
        'mileage_gps',
        'mileage_can',
        'engine_hours_gps',
        'engine_hours_can',
        'can_distance_till_service',
        'average_fuel_consumption_litre_per_km',
        'average_fuel_consumption_litre_per_hour',
        'average_fuel_consumption_kg_per_km',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}