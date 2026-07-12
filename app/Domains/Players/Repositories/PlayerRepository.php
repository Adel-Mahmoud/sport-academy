<?php

namespace App\Domains\Players\Repositories;

use App\Domains\Players\Models\Player;
use App\Domains\Players\DTOs\UpdatePlayerData;
 
class PlayerRepository
{
    public function all()
    {
        return Player::latest()->get();
    }

    public function find($id)
    {
        return Player::with('user')->find($id);
    }

    public function create(array $data)
    {
        $player = Player::create($data);

        return $player;
    }

    public function update($id, UpdatePlayerData $data)
    {
        $player = $this->find($id);

        $player->update($data->toArray());

        return $player;
    }

    public function delete($id)
    {
        return Player::destroy($id);
    }

    public function getPlayersByGroupId(int $groupId)
    {
        return Player::whereHas('groups', function ($query) use ($groupId) {
            $query->where('group_id', $groupId);
        })->get();
    }

    public function getPlayersByCoachId(int $coachId)
    {
        return Player::whereHas('coaches', function ($query) use ($coachId) {
            $query->where('coach_id', $coachId);
        })->get();
    }

    public function getPlayersBySportId(int $sportId)
    {
        return Player::whereHas('groups', function ($query) use ($sportId) {
            $query->where('sport_id', $sportId);
        })->get();
    }

    public function getActive()
    {
        return Player::active()->get();
    }

    public function getInactive()
    {
        return Player::inactive()->get();
    }

}
