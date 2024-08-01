<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRefuelingPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'refueling_station_id',
        'vehicle_id',
        'invoice_no',
        'account_id',
        'receipt_type_code',
        'payment_type_code',
        'confirm_date',
        'payment_date',
        'total_taxable_amount',
        'total_tax_amount',
        'total_amount',
        'remark',
        'payment_receipt',
        'reference',
        'qr_code_url',
        'created_by',
    ];

    /**
     * Get the refueling station associated with the refueling payment.
     */
    public function refuellingStation()
    {
        return $this->belongsTo(RefuellingStation::class);
    }

    /**
     * Get the vehicle associated with the refueling payment.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the account associated with the refueling payment.
     */
    public function account()
    {
        return $this->belongsTo(MetroBerryAccounts::class);
    }

    /**
     * Get the user who created the refueling payment.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

