<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
   
    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'payment_type',
        'amount',
        'currency',
        'payment_gateway',
        'gateway_transaction_id',
        'status',
        'subscription_plan_id',
        'mkeka_id',
        'expires_at',
    ];
}
