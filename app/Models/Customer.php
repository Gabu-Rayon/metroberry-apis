<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table  = 'customers';

    protected $fillable = [
        'user_id',
        'organisation_id',
        'customer_organisation_code',
    ];

    protected $hidden = [
        'id',
        'user_id',
        'organisation_id',
        'customer_roganisation_code',
        'is_email_verified',
        'is_contact_verified',
        'created_at',
        'updated_at',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function organisation() {
        return $this->belongsTo(Organisation::class);
    }
}