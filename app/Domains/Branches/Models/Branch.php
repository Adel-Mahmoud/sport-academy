<?php

namespace App\Domains\Branches\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'location',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function sports()
    {
        return $this->belongsToMany(\App\Domains\Sports\Models\Sport::class, 'branch_sport', 'branch_id', 'sport_id');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }
}