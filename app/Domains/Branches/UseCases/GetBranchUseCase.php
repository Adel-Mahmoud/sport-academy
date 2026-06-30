<?php

namespace App\Domains\Branches\UseCases;

use App\Domains\Branches\Models\Branch;
use App\Domains\Branches\Repositories\BranchRepository;

class GetBranchUseCase
{
    public function __construct(
        protected BranchRepository $repository
    ) {}

    public function execute(int $id): Branch
    {
        return $this->repository->find($id);
    }
}