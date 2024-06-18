<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleService extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'servicing_company_name',
        'servicing_company_address',
        'servicing_company_contact',
        'servicing_company_email',
        'servicing_done',
        'total_repairs',
        'total_repairs_costs',
        'payment_type_code',
        'invoice_no',
        'company_invoice_no',
        'servicing_date',
        'invoice_qr_code_url',
        'created_by',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
}