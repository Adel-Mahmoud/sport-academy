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
}