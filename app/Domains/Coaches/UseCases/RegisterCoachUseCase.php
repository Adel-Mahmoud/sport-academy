<?php

namespace App\Domains\Coaches\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Coaches\Models\Coach;
use App\Domains\Users\Services\UserService;
use App\Domains\Coaches\DTOs\CreateCoachData;
use App\Domains\Coaches\Repositories\CoachRepository;
use App\Domains\Sports\Repositories\SportRepository;
use App\Domains\Users\DTOs\CreateUserData;

class RegisterCoachUseCase
{
    public function __construct(
        protected UserService $userService,
        protected CoachRepository $coachRepository,
        protected SportRepository $sportRepository,
    ) {}

    public function execute(array $data): Coach
    {
        return DB::transaction(function () use ($data) {

            $coachData = CreateCoachData::fromArray($data);

            $userId = null;

            if ($coachData->email && $coachData->password) {

                $userData = CreateUserData::fromArray([
                    ...$data,
                    'roles' => ['coach'],
                ]);

                $user = $this->userService->registerUser($userData);

                $userId = $user->id;
            }

            $coach = $this->coachRepository->create([
                'user_id'    => $userId,
                'name'       => $coachData->name,
                'phone'      => $coachData->phone,
                'hire_date'  => $coachData->hire_date,
                'salary'     => $coachData->salary,
                'is_active'  => $coachData->is_active,
            ]);

            $this->attachSportsAndGroups($coach, $coachData);

            return $coach;
        });
    }

    protected function attachSportsAndGroups(
        Coach $coach,
        CreateCoachData $coachData
    ): void {

        foreach ($coachData->sports as $sportId) {

            $sport = $this->sportRepository->findWithGroupsCount($sportId);

            if ($sport->groups_count > 0) {

                if (isset($coachData->groups[$sportId])) {

                    $coach->groups()->attach(
                        $coachData->groups[$sportId],
                        [
                            'role'       => 'coach',
                            'is_primary' => true,
                            'is_active'  => true,
                        ]
                    );
                }

            } else {

                $coach->sports()->attach($sportId);

            }
        }
    }
}