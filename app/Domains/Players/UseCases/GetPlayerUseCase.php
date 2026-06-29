<?php
namespace App\Domains\Players\UseCases;
use App\Domains\Players\Models\Player;

class GetPlayerUseCase
{
    public function execute(int $id): Player
    {
        return Player::query()->findOrFail($id)->load('user');
    }
}