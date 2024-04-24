<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;
    protected $table = 'sports';
    protected $fillable = [
      'sport_name'
    ];

    public function coaches()
    {
        return $this->hasMany(Coach::class, 'sport_id');
    }
    
    public function players()
    {
        return $this->hasMany(Player::class, 'sport_id');
    }
    
    public function teams()
    {
        return $this->hasMany(Team::class, 'sport_id');
    }
}
