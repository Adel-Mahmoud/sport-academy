<?php

namespace App\Domains\Players\Services;

use Illuminate\Support\Facades\DB;
use App\Domains\Players\Models\Player;
use App\Domains\Users\Services\UserService;

class PlayerService
{
    protected UserService $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function registerPlayerWithUser(array $data): Player
    {
        return DB::transaction(function () use ($data) {
            $user = $this->userService->registerUser($data);

            $user->assignRole('player'); 

            $playerData = array_merge($data, ['user_id' => $user->id]);

            return Player::create($playerData);
        });
    }
}
