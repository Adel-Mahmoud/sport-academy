<?php

namespace App\Domains\Sports\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Sports\Models\Sport;
use App\Domains\Sports\Repositories\SportRepository;
use App\Domains\Sports\DTOs\UpdateSportData;

class UpdateSportUseCase
{
    public function __construct(
        protected SportRepository $sportRepository,
    ) {}

    public function execute(int $sportId, array $data): Sport
    {
        return DB::transaction(function () use ($sportId, $data) {

            $sport = $this->sportRepository->find($sportId);

            return $this->sportRepository->update(
                $sportId,
                UpdateSportData::fromArray($data)->toArray()
            );
        });
    }
}
