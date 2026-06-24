<?php

namespace App\Domains\Players\Actions;

use App\Domains\Players\DTOs\UpdatePlayerData;
use App\Domains\Players\Models\Player;
use App\Domains\Players\Repositories\PlayerRepository;

class UpdatePlayerAction
{
    public function __construct(
        private readonly PlayerRepository $repository,
    ) {
    }

    public function execute(int $id, UpdatePlayerData $data): Player
    {
        return $this->repository->update($id, $data->toArray());
    }
}
