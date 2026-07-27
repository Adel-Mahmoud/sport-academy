<?php

namespace App\Domains\Groups\Actions;
use App\Domains\Groups\Repositories\GroupRepository;

class AddPlayersToGroupAction
{
    public function __construct(
        protected GroupRepository $repository
    ) {}

    public function handle(int $groupId, array $playerIds)
    {
        return $this->repository->addPlayersToGroup($groupId,$playerIds);
    }
}