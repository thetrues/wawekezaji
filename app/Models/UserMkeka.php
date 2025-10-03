<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMkeka extends Model
{

    protected $table = 'user_mkeka_access';

    protected $fillable = [
        'user_id',
        'mkeka_id',
        'access_type',
        'payment_id',
        'expires_at',
    ];
}
