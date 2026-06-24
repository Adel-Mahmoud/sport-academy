<?php

namespace App\Domains\Players\Repositories;

use App\Domains\Players\Models\Player;

class PlayerRepository
{
    public function all()
    {
        return Player::all();
    }

    public function find($id)
    {
        return Player::find($id);
    }

    public function create(array $data)
    {
        return Player::create($data);
    }

    public function update($id, array $data)
    {
        $model = Player::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        return Player::destroy($id);
    }
}