<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    use HasFactory;
    protected $table = 'routes';
    protected $fillable = [
       'county',
       'created_by',
       'location',
       'start_location',
       'end_location'
    ];
}