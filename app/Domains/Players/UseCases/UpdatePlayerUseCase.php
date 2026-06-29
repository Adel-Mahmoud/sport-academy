<?php

namespace App\Domains\Players\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Players\Models\Player;
use App\Domains\Users\Services\UserService;
use App\Domains\Players\DTOs\UpdatePlayerData;
use App\Domains\Players\Repositories\PlayerRepository;
use App\Domains\Users\DTOs\UpdateUserData;

class UpdatePlayerUseCase
{
    public function __construct(
        protected UserService $userService,
        protected PlayerRepository $playerRepository,
    ) {}

    public function execute(
        UpdatePlayerData $data,
        ?string $imagePath = null
    ): Player {

        return DB::transaction(function () use ($data, $imagePath) {
            $this->userService->updateUser($data->toUserData());
            return $this->playerRepository->update(
                $data->id,
                [
                    'name' => $data->name,
                    'phone' => $data->phone,
                    'school' => $data->school,
                    'weight' => $data->weight,
                    'height' => $data->height,
                    'blood_type' => $data->blood_type,
                    'gender' => $data->gender,
                    'age' => $data->age,
                    'address' => $data->address,
                    'location' => $data->location,
                    'description' => $data->description,
                    'image' => $imagePath,
                    'national_id' => $data->national_id,
                ]
            );
        });
    }
}