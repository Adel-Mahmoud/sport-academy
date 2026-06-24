<?php

namespace App\Domains\Players\Actions;

use App\Domains\Players\Repositories\PlayerRepository;

class DeletePlayerAction
{
    public function __construct(
        private readonly PlayerRepository $repository,
    ) {
    }

    public function execute(int $id): bool
    {
        return (bool) $this->repository->delete($id);
    }
}
