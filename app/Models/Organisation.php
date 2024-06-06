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
        'created_by',
    ];
}