<?php

namespace App\Domains\Groups\Actions;

use App\Domains\Groups\Repositories\GroupRepository;

class TransferPlayersAction
{
    public function __construct(
        protected GroupRepository $repository
    ) {}

    public function handle(int $fromGroupId, int $targetGroupId, array $playerIds)
    {
        return $this->repository->transferPlayers($fromGroupId, $targetGroupId, $playerIds);
    }
}