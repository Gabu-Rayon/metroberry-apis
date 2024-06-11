<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = "billings_invoices";

    protected $fillable = [
        'trip_id',
        'customer_id',
        'invoice_no',
        'customer_tin',
        'customer_name',
        'receipt_type_code',
        'payment_type_code',
        'sales_status_code',
        'confirm_date',
        'sales_date',
        'cancel_request_date',
        'refund_reason_code',
        'total_taxable_amount',
        'total_tax_amount',
        'total_amount',
        'remark',
        'qr_code_url',
    ];


    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
       
}