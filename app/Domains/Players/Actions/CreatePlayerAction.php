<?php

namespace App\Domains\Players\Actions;
use App\Domains\Players\Models\Player;
use App\Domains\Players\Services\PlayerService;

class CreatePlayerAction
{
    protected $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function execute(array $data): Player
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('players', 'public');
        }

        return $this->playerService->registerPlayerWithUser($data);
    }
}
