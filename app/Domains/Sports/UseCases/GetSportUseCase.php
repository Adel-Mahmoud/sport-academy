<?php
namespace App\Domains\Sports\UseCases;
use App\Domains\Sports\Repositories\SportRepository;
use App\Domains\Sports\Models\Sport;

class GetSportUseCase
{
    public function __construct(
        protected SportRepository $sportRepository
    ) {}
    public function execute(int $id): Sport
    {
        return $this->sportRepository->find($id)->load(['branch']);
    }
}