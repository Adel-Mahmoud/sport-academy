<?php

namespace App\Domains\Sports\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Sports\Repositories\SportRepository;
use App\Domains\Sports\Models\Sport;
use App\Domains\Sports\DTOs\CreateSportData;

class RegisterSportUseCase
{
    public function __construct(
        protected SportRepository $sportRepository
    ) {}

    public function execute(array $data): Sport
    {
        return DB::transaction(function () use ($data) {

            $sportData = CreateSportData::fromArray($data);
            $sport = $this->sportRepository->create([
                'name' => $sportData->name,
                'branch_id' => $sportData->branch_id,
                'status' => $sportData->status,
            ]);

            return $sport;
        });
    }
}