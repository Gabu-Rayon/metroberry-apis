<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'organisation_id',
        'vehicle_id',
        'user_id',
        'national_id_no',
        'national_id_front_avatar',
        'national_id_behind_avatar',
        'status',
    ];

    protected $with = ['user'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function driverLicense() {
        return $this->hasOne(DriversLicenses::class);
    }

    public function vehicle() {
        return $this->hasOne(Vehicle::class);
    }
  
    public function organization() {
        return $this->belongsTo(Organisation::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function license () {
        return $this->hasOne(DriversLicenses::class);
    }
}