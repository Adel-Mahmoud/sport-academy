<?php

namespace App\Domains\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'project_name',
        'short_description',
        'phone',
        'address',
        'logo',
        'brand_image',
    ];
}