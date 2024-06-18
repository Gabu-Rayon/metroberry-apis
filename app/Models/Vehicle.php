<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'driver_id',
        'model',
        'make',
        'year',
        'plate_number',
        'color',
        'seats',
        'fuel_type',
        'engine_size',
        'vehicle_insurance_issue_date',
        'vehicle_insurance_expiry',
        'vehicle_insurance_issue_organisation',
        'vehicle_avatar',
        'status',
        'organisation_id'
    ];
    

    protected $hidden = [
        'driver_id',
        'organisation_id',
        'created_by',
        'created_at',
        'updated_at',
    ];
    


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    
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