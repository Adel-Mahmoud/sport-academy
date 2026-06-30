<?php

namespace App\Domains\Branches\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Branches\Models\Branch;
use App\Domains\Branches\DTOs\CreateBranchData;
use App\Domains\Branches\Repositories\BranchRepository;

class RegisterBranchUseCase
{
    public function __construct(
        protected BranchRepository $repository
    ) {}

    public function execute(array $data): Branch
    {
        return DB::transaction(function () use ($data) {
            $dto = CreateBranchData::fromArray($data);
            return $this->repository->create($dto->toArray());
        });
    }
}