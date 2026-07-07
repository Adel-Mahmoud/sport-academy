<?php

namespace App\Domains\Players\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'phone',
        'school',
        'weight',
        'height',
        'blood_type',
        'gender',
        'age',
        'address',
        'location',
        'description',
        'image',
        'national_id',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Domains\Users\Models\User::class, 'user_id');
    }

    public function coaches()
    {
        return $this->belongsToMany(\App\Domains\Coaches\Models\Coach::class, 'coach_player', 'player_id', 'coach_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function groups()
    {
        return $this->belongsToMany(\App\Domains\Groups\Models\Group::class, 'group_player', 'player_id', 'group_id')
            ->withPivot('joined_at', 'status')
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
