<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $table = 'subscription_plans';

    protected $fillable = [
        'name',
        'duration_days',
        'price',
        'is_active',
    ];
}
