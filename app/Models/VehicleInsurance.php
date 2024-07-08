<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleInsurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'insurance_company',
        'insurance_policy_no',
        'insurance_date_of_issue',
        'insurance_date_of_expiry',
        'insurance_avatar'
    ];
}
