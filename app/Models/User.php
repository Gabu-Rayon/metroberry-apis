<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'roles',
        'permissions',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'phone_status' => 'boolean',
        'email_status' => 'boolean',
        'organisation_status' => 'boolean',
        'password' => 'hashed',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'user_id');
    }

    public function createdCustomers()
    {
        return $this->hasMany(Customer::class, 'created_by');
    }

    public function organisation()
    {
        return $this->hasOne(Organisation::class, 'user_id');
    }

    public function createdOrganisations()
    {
        return $this->hasMany(Organisation::class, 'created_by');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($user) {
            $user->driver()->delete();
            $user->customer()->delete();
            $user->organisation()->delete();
        });
    }

    public function driver()
    {
        return $this->hasOne(Organisation::class, 'user_id');
    }

    public function createdDrivers()
    {
        return $this->hasMany(Driver::class, 'created_by');
    }


    public function createdVehicleServices()
    {
        return $this->hasMany(VehicleService::class, 'created_by');
    }
}