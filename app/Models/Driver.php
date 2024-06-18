<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organisation_id',
        'created_by',
        'status',
        'national_id_no',
        'national_id_avatar_front',
        'national_id_avatar_behind',
        'sex',
        'date_of_birth',
        'driving_license_no',
        'driving_license_date_issued',
        'driving_license_date_expiry',
        'dl_county_of_residence',
        'dl_avatar_front',
        'dl_avatar_behind',
    ];

    protected $with = ['user'];

    protected $hidden = [
        'id',
        'user_id',
        'organisation_id',
        'customer_organisation_code',
        'is_email_verified',
        'is_contact_verified',
        'created_at',
        'updated_at',
        'vehicle_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
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
}