<?php

namespace App\Domains\Players\Services;

use App\Domains\Players\Models\Player;
use App\Shared\Services\ImageService;
use Illuminate\Support\Facades\DB;

class PlayerDeleteService
{
    public function __construct(
        protected ImageService $imageService
    ) {}

    public function delete(Player $player): void
    {
        DB::transaction(function () use ($player) {

            if ($player->image) {
                $this->imageService->delete($player);
            }

            $player->delete();
        });
    }
}