<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRepairPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'part_id',
        'repair_type',
        'repair_cost',
        'invoice_id',
        'account_id',
        'receipt_type_code',
        'payment_type_code',
        'confirm_date',
        'payment_date',
        'total_taxable',
        'amount',
        'total_amount',
        'remark',
        'payment_receipt',
        'reference',
        'qr_code_url',
        'created_by'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function part()
    {
        return $this->belongsTo(VehiclePart::class);
    }

    public function account()
    {
        return $this->belongsTo(MetroBerryAccounts::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}