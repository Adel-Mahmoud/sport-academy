<?php

namespace App\Domains\Coaches\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'phone',
        'hire_date',
        'salary',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Domains\Users\Models\User::class, 'user_id');
    }

    public function groups()
    {
        return $this->belongsToMany(\App\Domains\Groups\Models\Group::class, 'group_coach', 'coach_id', 'group_id')
            ->withPivot('role', 'is_primary', 'is_active')
            ->withTimestamps();
    }

    public function sports()
    {
        return $this->belongsToMany(\App\Domains\Sports\Models\Sport::class, 'coach_sport', 'coach_id', 'sport_id')
            ->withTimestamps();
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