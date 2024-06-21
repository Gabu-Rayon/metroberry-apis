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
        'created_by',
        'make',
        'model',
        'year',
        'color',
        'seats',
        'fuel_type',
        'engine_size',
        'vehicle_avatar',
        'plate_number',
        'logbook_avatar',
        'insurance_company',
        'insurance_policy_no',
        'insurance_date_of_issue',
        'insurance_date_of_expiry',
        'insurance_avatar',
        'ntsa_inspection_certificate_no',
        'ntsa_inspection_certificate_date_of_issue',
        'ntsa_inspection_certificate_date_of_expiry',
        'ntsa_inspection_certificate_avatar',
        'status',
    ];

    

    protected $hidden = [
        'organisation_id',
        'created_by',
        'created_at',
        'updated_at',
    ];
    
    protected $with = ['driver'];


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function driver() {
        return $this->belongsTo(Driver::class,'driver_id');
    }

    public function organisation() {
        return $this->belongsTo(Organisation::class,'organisation_id');
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