<?php

namespace App\Domains\Coaches\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Coaches\Models\Coach;
use App\Domains\Users\Services\UserService;
use App\Domains\Coaches\DTOs\UpdateCoachData;
use App\Domains\Coaches\Repositories\CoachRepository;
use App\Domains\Users\DTOs\UpdateUserData;
use App\Domains\Users\DTOs\CreateUserData;

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
            $coachData = UpdateCoachData::fromArray($data);
            $userId = $coach->user_id;
            $userToDelete = null;

            if ($coachData->has_account) {
                if ($userId) {
                    $this->userService->updateUser(
                        UpdateUserData::fromArray([
                            'id'       => $userId,
                            'name'     => $coachData->name,
                            'email'    => $data['email'],
                            'phone'    => $coachData->phone ?? null,
                            'password' => $data['password'] ?? null,
                        ])
                    );
                } else {
                    $data['roles'] = ['coach'];
                    $newUser = $this->userService->registerUser(CreateUserData::fromArray($data));
                    $userId = $newUser->id;
                }
            } else {
                if ($userId) {
                    $userToDelete = $userId;
                    $userId = null; 
                }
            }

            $updatedCoach = $this->coachRepository->update($coachId, [
                'user_id'   => $userId,
                'name'      => $coachData->name,
                'phone'     => $coachData->phone,
                'hire_date' => $coachData->hire_date,
                'salary'    => $coachData->salary,
                'is_active' => $coachData->is_active,
            ]);

            if ($userToDelete) {
                $this->userService->deleteUser($userToDelete);
            }

            return $updatedCoach;
        });
    }
}