<?php

namespace App\Domains\Sports\Models;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $fillable = [
        'name',
        'branch_id',
        'is_active'
    ];

    public function branch()
    {
        return $this->belongsTo(\App\Domains\Branches\Models\Branch::class);
    }

    public function groups()
    {
        return $this->hasMany(\App\Domains\Groups\Models\Group::class);
    }

    public function levels()
    {
        return $this->hasMany(SportLevel::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
