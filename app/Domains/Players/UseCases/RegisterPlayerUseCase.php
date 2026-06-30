<?php

namespace App\Domains\Players\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Players\Models\Player;
use App\Domains\Users\Services\UserService;
use App\Domains\Players\DTOs\CreatePlayerData;
use App\Domains\Players\Repositories\PlayerRepository;
use App\Domains\Users\DTOs\CreateUserData;
use Spatie\Permission\Models\Role;

class RegisterPlayerUseCase
{
    public function __construct(
        protected UserService $userService,
        protected PlayerRepository $playerRepository
    ) {}

    public function execute(array $data, ?string $tempImagePath = null): Player
    {
        return DB::transaction(function () use ($data, $tempImagePath) {

            $playerData = CreatePlayerData::fromArray($data);
            $data['roles'] = ['player'];
            $user = $this->userService->registerUser(CreateUserData::fromArray($data));


            if (! $user->exists) {
                throw new \Exception('Player creation failed');
            } else {
                Role::firstOrCreate([
                    'name' => 'player',
                    'guard_name' => 'admin',
                ]);
            }

            $player = $this->playerRepository->create([
                'user_id' => $user->id,
                'name' => $playerData->name,
                'phone' => $playerData->phone,
                'school' => $playerData->school ?? null,
                'weight' => $playerData->weight ?? null,
                'height' => $playerData->height ?? null,
                'blood_type' => $playerData->blood_type ?? null,
                'gender' => $playerData->gender,
                'age' => $playerData->age,
                'address' => $playerData->address ?? null,
                'location' => $playerData->location ?? null,
                'description' => $playerData->description ?? null,
                'image' => $tempImagePath ? $tempImagePath : null,
                'national_id' => $playerData->national_id,
            ]);

            // DB::afterCommit(function () use ($player, $tempImagePath) {
            //     event(new PlayerCreated($player, $tempImagePath));
            // });
            return $player;
        });
    }
}