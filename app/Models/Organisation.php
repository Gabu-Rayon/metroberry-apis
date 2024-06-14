<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organisation extends Model
{
    use HasFactory;
    protected $table = 'organisations';
    protected $fillable = [
        'user_id',
        'created_by',
    ];

    protected $with = ['customers', 'vehicles', 'drivers'];

    public function drivers() {
        return $this->hasMany(Driver::class);
    }

    public function vehicles() {
        return $this->hasMany(Vehicle::class);
    }


    /**
     * Get the customers that belong to the organisation.
     */
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'organisation_id', 'id');
    }
        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the relationship to the user who owns the organisation
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the relationship to the user who created the organisation
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
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