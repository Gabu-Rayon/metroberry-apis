<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteLocations extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_id',
        'is_start_location',
        'is_end_location',
        'is_waypoint',
        'name'
    ];
}
