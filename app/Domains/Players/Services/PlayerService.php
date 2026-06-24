<?php

namespace App\Domains\Players\Services;

use App\Domains\Players\Actions\CreatePlayerAction;
use App\Domains\Players\Actions\DeletePlayerAction;
use App\Domains\Players\Actions\UpdatePlayerAction;
use App\Domains\Players\DTOs\CreatePlayerData;
use App\Domains\Players\DTOs\UpdatePlayerData;
use App\Domains\Players\Models\Player;
use App\Domains\Players\Repositories\PlayerRepository;
use Illuminate\Database\Eloquent\Collection;

class PlayerService
{
    public function __construct(
        private readonly PlayerRepository $repository,
        private readonly CreatePlayerAction $createPlayerAction,
        private readonly UpdatePlayerAction $updatePlayerAction,
        private readonly DeletePlayerAction $deletePlayerAction,
    ) {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int $id): ?Player
    {
        return $this->repository->find($id);
    }

    public function create(CreatePlayerData $data): Player
    {
        return $this->createPlayerAction->execute($data);
    }

    public function update(int $id, UpdatePlayerData $data): Player
    {
        return $this->updatePlayerAction->execute($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->deletePlayerAction->execute($id);
    }
}
