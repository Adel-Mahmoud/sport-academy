<?php

namespace App\Domains\Sports\Models;

use Illuminate\Database\Eloquent\Model;

class SportLevel extends Model
{
    protected $fillable = [
        'name',
        'sport_id',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }
}