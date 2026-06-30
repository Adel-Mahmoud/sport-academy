<?php

namespace App\Domains\Players\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Players\Models\Player;
use App\Domains\Users\Services\UserService;
use App\Domains\Players\DTOs\UpdatePlayerData;
use App\Domains\Users\DTOs\UpdateUserData;
use App\Domains\Players\Repositories\PlayerRepository;

class UpdatePlayerUseCase
{
    public function __construct(
        protected UserService $userService,
        protected PlayerRepository $playerRepository,
    ) {}

    public function execute(
        int $playerId,
        array $data,
    ): Player {

        return DB::transaction(function () use ($playerId, $data) {
            $player = $this->playerRepository->find($playerId);
            $data['id'] = $player->user_id;
            $this->userService->updateUser(UpdateUserData::fromArray($data));
            return $this->playerRepository->update(
                $playerId,
                UpdatePlayerData::fromArray($data)
            );
        });
    }
}
