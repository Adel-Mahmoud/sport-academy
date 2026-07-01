<?php

namespace App\Domains\Branches\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'location',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function sports()
    {
        return $this->belongsToMany(\App\Domains\Sports\Models\Sport::class, 'branch_sport', 'branch_id', 'sport_id');
    }
    // get branches is active
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}