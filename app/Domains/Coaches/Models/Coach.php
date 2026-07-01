<?php

namespace App\Domains\Coaches\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'phone',
        'email',
        'hire_date',
        'salary',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Domains\Users\Models\User::class, 'user_id');
    }

    public function groups()
    {
        return $this->belongsToMany(\App\Domains\Groups\Models\Group::class, 'group_coach', 'coach_id', 'group_id')
            ->withPivot('role', 'is_primary', 'status')
            ->withTimestamps();
    }

    public function sports()
    {
        return $this->belongsToMany(\App\Domains\Sports\Models\Sport::class, 'coach_sport', 'coach_id', 'sport_id')
            ->withTimestamps();
    }
}