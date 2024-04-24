<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'team_name','sport_id'
    ];
    
    public function sport()
    {
        return $this->belongsTo('App\Models\Sport');
    }
    
    public function players()
    {
        return $this->hasMany(Player::class, 'sport_id');
    }
}
