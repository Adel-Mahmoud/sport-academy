<?php
namespace App\Domains\Coaches\UseCases;
use App\Domains\Coaches\Repositories\CoachRepository;
use App\Domains\Coaches\Models\Coach;

class GetCoachUseCase
{
    public function __construct(
        protected CoachRepository $coachRepository
    ) {}
    public function execute(int $id): Coach
    {
        return $this->coachRepository->find($id);
    }
}