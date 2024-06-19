<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'created_by'
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
        'permissions',
    ];

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

    public function driver(): HasMany
    {
        return $this->hasMany(Driver::class, 'user_id', 'id');
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'user_id', 'id');
    }
    public function organisation() {
        return $this->hasOne(Organisation::class, 'user_id', 'id');
    }

    public static function boot () {
        parent::boot();
        static::deleting(function($user) {
            $user->driver()->delete();
            $user->customers()->delete();
            $user->organisation()->delete();
        });
    }
    public function createdVehicleServices()
    {
        return $this->hasMany(VehicleService::class, 'created_by');
    }
}