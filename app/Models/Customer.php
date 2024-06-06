<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
     protected $table  = 'customers';
    protected $fillable = [
         'name',
         'username',
         'organisation_id',
         'customer_roganisation_code',
         'contact',
         'email',
         'home_address',
         'password',
         'avatar',
         'is_email_verified',
         'is_contact_verified',
    ];
}