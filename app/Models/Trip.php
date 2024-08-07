<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Trip extends Model
{
    use HasFactory;

    protected $table = "trips";

    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'route_id',
        'pick_up_time',
        'drop_off_time',
        'distance',
        'number_of_passengers',
        'pick_up_location',
        'drop_off_location',
        'trip_date',
        'status',
        'vehicle_mileage',
        'engine_hours',
        'fuel_consumed',
        'idle_time',
        'billing_rate_id',
        'billed_by',
        'total_price',
        'billed_at',
        'created_by'
    ];

    protected $casts = [
        'is_billable' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function route()
    {
        return $this->belongsTo(Routes::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function billingRate()
    {
        return $this->belongsTo(BillingRates::class);
    }

    public function payments()
    {
        return $this->hasMany(TripPayment::class);
    }

    public function is_billable()
    {
        $can_be_billed = 0;

        Log::info('CAN BE BILLED ONE: ' . $can_be_billed);

        if (
            $this->status == 'completed' &&
            $this->drop_off_time != null &&
            $this->fuel_consumed != null &&
            $this->engine_hours != null &&
            $this->vehicle_mileage != null &&
            $this->idle_time != null
        ) {

            $can_be_billed = 1;
        }

        Log::info('CAN BE BILLED: ' . $can_be_billed);

        return $can_be_billed;
    }
}
