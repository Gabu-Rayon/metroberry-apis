<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasPermissions, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'password',
        'remember_token',
        'roles',
        'permissions',
    ];

    protected $with = ['organisation', 'driver', 'customer'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'phone_status' => 'boolean',
            'email_status' => 'boolean',
            'organisation_status' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function driver() {
        return $this->hasOne(Driver::class);
    }

    public function customer() {
        return $this->hasOne(Customer::class);
    }

    public function organisation() {
        return $this->hasOne(Organisation::class);
    }

    public static function boot () {
        parent::boot();
        static::deleting(function($user) {
            $user->driver()->delete();
            $user->customer()->delete();
            $user->organisation()->delete();
        });
    }


    public function createdVehicleServices()
    {
        return $this->hasMany(VehicleService::class, 'created_by');
    }
}