<?php

namespace App\Domains\Groups\Repositories;

use App\Domains\Groups\Models\Group;
use App\Domains\Players\Models\Player;

class GroupRepository
{
    public function all()
    {
        return Group::latest()->get();
    }

    // public function getBranches()
    // {
    //     return Group::select('branch_id')->distinct()->get();
    // }

    public function find(int $id): ?Group
    {
        return Group::with(['sport'])->find($id);
    }

    public function create(array $data): Group
    {
        return Group::create($data);
    }

    public function update(int $id, array $data): Group
    {
        $group = Group::findOrFail($id);
        $group->update($data);
        return $group;
    }

    public function delete(int $id): void
    {
        Group::destroy($id);
    }

    public function getActive()
    {
        return Group::active()->get();
    }

    public function getInactive()
    {
        return Group::inactive()->get();
    }

    public function getSports()
    {
        return Group::select('sport_id')->distinct()->get();
    }

    public function getOtherGroupsInSameSport(int $groupId)
    {
        $group = Group::findOrFail($groupId);

        return Group::where('sport_id', $group->sport_id)
            ->where('id', '!=', $groupId)
            ->latest()
            ->get();
    }
    
    public function getGroupCoaches(int $groupId)
    {
        return Group::findOrFail($groupId)->coaches()->get();
    }

    public function getGroupPlayers(int $groupId)
    {
        return Group::findOrFail($groupId)
            ->players()
            ->where('players.is_active', true)
            ->latest('players.name')
            ->get();
    }

    public function getAvailablePlayers(int $groupId)
    {
        return Player::active()
            ->whereDoesntHave('groups', function ($query) use ($groupId) {
                $query->where('groups.id', $groupId);
            })
            ->orderBy('name')
            ->get();
    }

    public function addPlayersToGroup(int $groupId, array $playerIds)
    {
        $group = Group::findOrFail($groupId);

        $attachData = [];
        $now = now();

        foreach ($playerIds as $playerId) {
            $attachData[$playerId] = [
                'joined_at' => $now,
            ];
        }

        return $group->players()->syncWithoutDetaching($attachData);
    }
}
