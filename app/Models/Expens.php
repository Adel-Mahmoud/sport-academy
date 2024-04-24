<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expens extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $fillable = [
      'expens','reason','date_at'
    ];
}
