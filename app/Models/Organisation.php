<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;
    protected $table = 'organisations';
    protected $fillable = [
        'user_id',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function drivers() {
        return $this->hasMany(Driver::class);
    }

    public function vehicles() {
        return $this->hasMany(Vehicle::class);
    }

    public function customers() {
        return $this->hasMany(Customer::class);
    }
}