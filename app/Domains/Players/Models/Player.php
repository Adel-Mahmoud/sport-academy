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
        'national_id'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Domains\Auth\Models\Admin::class, 'user_id');
    }
}
