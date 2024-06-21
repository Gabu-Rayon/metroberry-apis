<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organisation_id',
        'vehicle_id',
        'created_by',
        'national_id_no',
        'date_of_birth',
        'sex',
        'national_id_avatar_front',
        'national_id_avatar_back',
        'driving_license_no',
        'driving_license_date_of_issue',
        'driving_license_date_of_expiry',
        'driving_license_avatar_front',
        'driving_license_avatar_back',
        'psv_badge_no',
        'psv_badge_date_of_issue',
        'psv_badge_date_of_expiry',
        'psv_badge_avatar',
        'kra_pin_certificate_no',
        'kra_pin_certificate_avatar',
        'certificate_of_good_conduct_no',
        'certificate_of_good_conduct_issue_date',
        'certificate_of_good_conduct_expiry_date',
        'certificate_of_good_conduct_avatar',
        'status'
    ];

    protected $with = ['user'];

    protected $hidden = [
        'user_id',
        'organisation_id',
        'customer_organisation_code',
        'is_email_verified',
        'is_contact_verified',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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