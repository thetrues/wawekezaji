<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportCategory extends Model
{
    protected $table = 'sports_categories';

    protected $fillable = [
        'name',
        'icon',
        'is_active',
    ];
}
