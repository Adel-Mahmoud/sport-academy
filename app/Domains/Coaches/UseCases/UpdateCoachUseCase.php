<?php

namespace App\Domains\Coaches\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Coaches\Models\Coach;
use App\Domains\Users\Services\UserService;
use App\Domains\Users\DTOs\UpdateUserData;
use App\Domains\Coaches\DTOs\UpdateCoachData;
use App\Domains\Coaches\Repositories\CoachRepository;

class UpdateCoachUseCase
{
    public function __construct(
        protected UserService $userService,
        protected CoachRepository $coachRepository,
    ) {}

    public function execute(int $coachId, array $data): Coach
    {
        return DB::transaction(function () use ($coachId, $data) {

            $coach = $this->coachRepository->find($coachId);

            $this->userService->updateUser(
                UpdateUserData::fromArray([
                    'id' => $coach->user_id,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'] ?? null,
                ])
            );

            return $this->coachRepository->update(
                $coachId,
                UpdateCoachData::fromArray($data)->toArray()
            );
        });
    }
}
