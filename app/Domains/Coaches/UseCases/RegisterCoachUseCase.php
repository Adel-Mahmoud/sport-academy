<?php

namespace App\Domains\Coaches\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Coaches\Models\Coach;
use App\Domains\Users\Services\UserService;
use App\Domains\Coaches\DTOs\CreateCoachData;
use App\Domains\Coaches\Repositories\CoachRepository;
use App\Domains\Users\DTOs\CreateUserData;

class RegisterCoachUseCase
{
    public function __construct(
        protected UserService $userService,
        protected CoachRepository $coachRepository
    ) {}

    public function execute(array $data): Coach
    {
        return DB::transaction(function () use ($data) {

            $coachData = CreateCoachData::fromArray($data);

            $userId = null;
            if (isset($coachData->email, $coachData->password)) {
                $data['roles'] = ['coach'];
                $user = $this->userService->registerUser(CreateUserData::fromArray($data));
                $userId = $user->id;
            }

            $coach = $this->coachRepository->create([
                'user_id' => $userId,
                'name' => $coachData->name,
                'phone' => $coachData->phone,
                'hire_date' => $coachData->hire_date,
                'salary' => $coachData->salary,
                'is_active' => $coachData->is_active ?? true,
            ]);

            return $coach;
        });
    }
}
