<?php
namespace App\Domains\Players\UseCases;
use App\Domains\Players\Repositories\PlayerRepository;
use App\Domains\Players\Models\Player;

class GetPlayerUseCase
{
    public function __construct(protected PlayerRepository $playerRepository)
    {
    }
    public function execute(int $id): Player
    {
        return $this->playerRepository->find($id)->whileLoading('user');
    }
}