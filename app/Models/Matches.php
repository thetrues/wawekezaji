<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'mkeka_id',
        'team_a',
        'team_b',
        'match_date',
        'sport_category_id',
        'prediction',
        'odds',
        'analysis',
        'status',
    ];

    public function mkeka()
    {
        return $this->belongsTo(Mkeka::class, 'mkeka_id');
    }
}
