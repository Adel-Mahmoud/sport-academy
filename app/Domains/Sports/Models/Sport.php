<?php

namespace App\Domains\Sports\Models;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $fillable = [
        'name',
        'branch_id',
        'status'
    ];

    public function branch()
    {
        return $this->belongsTo(\App\Domains\Branches\Models\Branch::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}