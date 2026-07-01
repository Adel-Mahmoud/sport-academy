<?php

namespace App\Domains\Groups\UseCases;

use App\Domains\Groups\Models\Group;
use App\Domains\Groups\Repositories\GroupRepository;

class GetGroupUseCase
{
    public function __construct(
        protected GroupRepository $repository
    ) {}

    public function execute(int $id): Group
    {
        return $this->repository->find($id);
    }
}