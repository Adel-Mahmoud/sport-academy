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
        return Player::findOrFail($id);
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
}
