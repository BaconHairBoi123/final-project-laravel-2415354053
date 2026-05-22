<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'customer_id',
        'service_id',
        'start_date',
        'end_date',
        'status',
    ];
}