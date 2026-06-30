<?php

namespace App\Domains\Branches\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Branches\Models\Branch;
use App\Domains\Branches\DTOs\UpdateBranchData;
use App\Domains\Branches\Repositories\BranchRepository;

class UpdateBranchUseCase
{
    public function __construct(
        protected BranchRepository $repository
    ) {}

    public function execute(int $id, array $data): Branch
    {
        return DB::transaction(function () use ($id, $data) {
            $dto = UpdateBranchData::fromArray($data);
            return $this->repository->update($id, $dto->toArray());
        });
    }
}