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
        return $this->belongsTo(\App\Domains\Auth\Models\Admin::class, 'user_id');
    }
}