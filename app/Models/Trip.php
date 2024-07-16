<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    
    protected $table = "trips";
    
    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'route_id',
        'pick_up_time',
        'pick_up_location',
        'drop_off_location',
        'trip_date',
        'drop_off_time',
        'status',
        'vehicle_mileage',
        'engine_hours',
        'fuel_consumed',
        'idle_time'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function route (){
        return $this->belongsTo(Routes::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver(){
        return $this->belongsTo(Driver::class);
    }


    public function billingsInvoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getIsBillableAttribute(){
        return $this->status == 'completed' && $this->drop_off_time && $this->fuel_consumed && $this->engine_hours && $this->vehicle_mileage && $this->idle_time;
    }
}