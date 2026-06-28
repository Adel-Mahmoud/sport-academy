<?php

namespace App\Domains\Players\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Players\Models\Player;
use App\Domains\Users\Services\UserService;
use App\Domains\Users\DTOs\CreateUserData;
use App\Domains\Players\Events\PlayerCreated;
use Spatie\Permission\Models\Role;

class RegisterPlayerUseCase
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function execute(array $data, ?string $tempImagePath = null): Player
    {
        return DB::transaction(function () use ($data, $tempImagePath) {

            $user = $this->userService->registerUser(
                new CreateUserData(
                    name: $data['name'],
                    email: $data['email'],
                    password: $data['password'],
                    roles: ['player']
                )
            );
            if (! $user->exists) {
                throw new \Exception('Player creation failed');
            } else {
                Role::firstOrCreate([
                    'name' => 'player',
                    'guard_name' => 'admin',
                ]);
            }

            $player = Player::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'phone' => $data['phone'],
                'school' => $data['school'] ?? null,
                'weight' => $data['weight'] ?? null,
                'height' => $data['height'] ?? null,
                'blood_type' => $data['blood_type'] ?? null,
                'gender' => $data['gender'],
                'age' => $data['age'],
                'address' => $data['address'] ?? null,
                'location' => $data['location'] ?? null,
                'description' => $data['description'] ?? null,
                'image' => $tempImagePath ? $tempImagePath : null,
                'national_id' => $data['national_id'],
            ]);

            DB::afterCommit(function () use ($player, $tempImagePath) {
                event(new PlayerCreated($player, $tempImagePath));
            });
            return $player;
        });
    }
}