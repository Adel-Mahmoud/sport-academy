<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;
    protected $table = 'coaches';
    protected $fillable = [
       "coach_name","sport_id" 
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }
}
