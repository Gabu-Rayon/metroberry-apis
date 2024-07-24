<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'organisation_id',
        'customer_organisation_code',
        'national_id_no',
        'national_id_front_avatar',
        'national_id_behind_avatar',
        'created_by',
        'status'
    ];
    protected $hidden = [
        'user_id',
        'organisation_id',
        'is_email_verified',
        'is_contact_verified',
        'created_at',
        'updated_at',
    ];

    protected $with = ['user', 'creator'];

    // casts
    protected $casts = [
        'isTrippedForNow' => 'boolean',
    ];

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

    public function isTrippedForNow()
    {
        $timezone = 'Africa/Nairobi';

        $now = Carbon::now($timezone);
        $oneHourLater = $now->copy()->addHour();

        $currentDate = $now->format('Y-m-d');
        $currentTime = $now->format('H:i:s');
        $oneHourLaterTime = $oneHourLater->format('H:i:s');

        // Use the defined 'trips' relationship to query for existing trips
        $exists = $this->trips() // Use the 'trips' relationship method
            ->where('trip_date', '=', $currentDate)
            ->whereBetween('pick_up_time', [$currentTime, $oneHourLaterTime])
            ->exists();

        return $exists;
    }


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($customer) {
            $customer->user->delete();
        });
    }
}
