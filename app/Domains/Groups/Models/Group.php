<?php

namespace App\Domains\Groups\Models;

use App\Domains\Coaches\Models\Coach;
use App\Domains\Players\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = [
        'sport_id',
        'branch_id',
        'name',
        'level',
        'description',
        'status',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(\App\Domains\Sports\Models\Sport::class, 'sport_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(\App\Domains\Branches\Models\Branch::class, 'branch_id');
    }

    public function coaches(): BelongsToMany
    {
        return $this->belongsToMany(Coach::class, 'group_coach', 'group_id', 'coach_id')
            ->withPivot('role', 'is_primary', 'status')
            ->withTimestamps();
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'group_player', 'group_id', 'player_id')
            ->withPivot('joined_at', 'status')
            ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

}