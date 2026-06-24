<?php

namespace App\Domains\Players\Actions;

use App\Domains\Players\DTOs\CreatePlayerData;
use App\Domains\Players\Models\Player;
use App\Domains\Players\Repositories\PlayerRepository;

class CreatePlayerAction
{
    public function __construct(
        private readonly PlayerRepository $repository,
    ) {
    }

    public function execute(CreatePlayerData $data): Player
    {
        return $this->repository->create($data->toArray());
    }
}
