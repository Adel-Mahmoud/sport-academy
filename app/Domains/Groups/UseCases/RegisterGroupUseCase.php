<?php

namespace App\Domains\Groups\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Groups\Models\Group;
use App\Domains\Groups\DTOs\CreateGroupData;
use App\Domains\Groups\Repositories\GroupRepository;

class RegisterGroupUseCase
{
    public function __construct(
        protected GroupRepository $repository
    ) {}

    public function execute(array $data): Group
    {
        return DB::transaction(function () use ($data) {
            $dto = CreateGroupData::fromArray($data);
            return $this->repository->create($dto->toArray());
        });
    }
}