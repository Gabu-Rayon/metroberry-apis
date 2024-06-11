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
        'created_by',
    ];

    protected $with = ['user', 'drivers', 'vehicles', 'customers'];

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

    protected static function boot() {
        parent::boot();
        static::deleting(function($organisation) {
            $organisation->drivers()->delete();
            $organisation->vehicles()->delete();
            $organisation->customers()->delete();
            $organisation->user()->delete();
        });
    }
}