<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $table = 'players';
    protected $fillable = [
      "player_name","date_of_pirth","phone","email","profile_picture","id_card_picture","club_membership_picture","sport_id","team_id"
    ];
    
    public function subscriptions()
    {
        return $this->hasMany('App\Models\Subscription');
    }
    
    public function sport()
    {
        return $this->belongsTo('App\Models\Sport');
    }
    
    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }
}
