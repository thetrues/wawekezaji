<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mkeka extends Model
{
    protected $table = 'mikekas';

    protected $fillable = [
        'title',
        'description',
        'total_odds',
        'sport_category_id',
        'visibility_type',
        'pay_per_view_price',
        'status',
        'created_by',
    ];

    public function matches()
    {
        return $this->hasMany(Matches::class, 'mkeka_id');
    }
}
