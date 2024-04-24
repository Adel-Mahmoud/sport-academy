<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'subscriptions';
    protected $fillable = [
      "player_id","sport_id","subscribe","note"  
    ];

    public function player()
    {
        return $this->belongsTo('App\Models\Player');
    }
}
