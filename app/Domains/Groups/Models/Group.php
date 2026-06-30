<?php

namespace App\Domains\Groups\Models;

use App\Domains\Coaches\Models\Coach;
use App\Domains\Players\Models\Player;
use App\Domains\Auth\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Group extends Model
{
    protected $table = 'academy_groups';
    protected $fillable = [
        'sport_id',
        // 'branch_id',
        'name',
        'level',
    ];


    /**
     * Get the branch that owns the group.
     */
    // public function branch(): BelongsTo
    // {
    //     return $this->belongsTo(Branch::class);
    // }
    public function user(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }


    public function coaches(): BelongsToMany
    {
        return $this->belongsToMany(Coach::class)
                    ->withPivot('role', 'is_primary')
                    ->withTimestamps();
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class)
                    ->withPivot('joined_at', 'status')
                    ->withTimestamps();
    }

}