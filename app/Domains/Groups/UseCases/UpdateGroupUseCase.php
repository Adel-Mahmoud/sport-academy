<?php

namespace App\Domains\Groups\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Groups\Models\Group;
use App\Domains\Groups\DTOs\UpdateGroupData;
use App\Domains\Groups\Repositories\GroupRepository;

class UpdateGroupUseCase
{
    public function __construct(
        protected GroupRepository $repository
    ) {}

    public function execute(int $id, array $data): Group
    {
        return DB::transaction(function () use ($id, $data) {
            $dto = UpdateGroupData::fromArray($data);
            return $this->repository->update($id, $dto->toArray());
        });
    }
}