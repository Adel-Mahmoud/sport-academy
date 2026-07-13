<?php

namespace App\Domains\Groups\Actions;
use App\Domains\Groups\Repositories\GroupRepository;

class GetGroupPlayersAction
{
    public function __construct(
        protected GroupRepository $repository
    ) {}

    public function handle(int $groupId)
    {
        return $this->repository->getGroupPlayers($groupId);
    }
}