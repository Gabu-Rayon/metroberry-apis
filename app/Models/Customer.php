<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'organisation_id',
        'customer_organisation_code',
    ];

    protected $hidden = [
        'user_id',
        'organisation_id',
        'is_email_verified',
        'is_contact_verified',
        'created_at',
        'updated_at',
    ];

    protected $with = ['user','creator'];

    /**
     * Get the user that owns the customer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the creator that owns the customer.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the organisation that owns the customer.
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class, 'organisation_id', 'id');
    }
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function billingsInvoices()
    {
        return $this->hasMany(Invoice::class);
    }
}