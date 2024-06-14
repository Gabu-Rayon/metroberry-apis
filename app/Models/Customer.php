<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'organisation_id',
        'customer_organisation_code',
        'created_by'
    ];

    protected $hidden = [
        'user_id',
        'organisation_id',
        'is_email_verified',
        'is_contact_verified',
        'created_at',
        'updated_at',
    ];

    protected $with = ['user', 'creator', 'organisation'];

    // Define the relationship to the user who is the customer
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the relationship to the user who created the customer
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Define the relationship to the organisation
    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }
    // Define the relationship to the trips
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    // Define the relationship to the invoices
    public function billingsInvoices()
    {
        return $this->hasMany(Invoice::class);
    }
}