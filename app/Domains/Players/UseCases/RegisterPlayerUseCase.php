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
        protected PlayerRepository $playerRepository,
        protected CreatePlayerData $createPlayerData
    ) {}

    public function execute(array $data, ?string $tempImagePath = null): Player
    {
        return DB::transaction(function () use ($data, $tempImagePath) {
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
                'name' => $this->createPlayerData->name,
                'phone' => $this->createPlayerData->phone,
                'school' => $this->createPlayerData->school ?? null,
                'weight' => $this->createPlayerData->weight ?? null,
                'height' => $this->createPlayerData->height ?? null,
                'blood_type' => $this->createPlayerData->blood_type ?? null,
                'gender' => $this->createPlayerData->gender,
                'age' => $this->createPlayerData->age,
                'address' => $this->createPlayerData->address ?? null,
                'location' => $this->createPlayerData->location ?? null,
                'description' => $this->createPlayerData->description ?? null,
                'image' => $tempImagePath ? $tempImagePath : null,
                'national_id' => $this->createPlayerData->national_id,
            ]);

            // DB::afterCommit(function () use ($player, $tempImagePath) {
            //     event(new PlayerCreated($player, $tempImagePath));
            // });
            return $player;
        });
    }
}