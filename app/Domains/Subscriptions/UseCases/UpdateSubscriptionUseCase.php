<?php

namespace App\Domains\Subscriptions\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Subscriptions\Models\Subscription;
use App\Domains\Subscriptions\DTOs\UpdateSubscriptionData;
use App\Domains\Subscriptions\Repositories\SubscriptionRepository;

class UpdateSubscriptionUseCase
{
    public function __construct(
        protected SubscriptionRepository $repository
    ) {}

    public function execute(int $id, array $data): Subscription
    {
        return DB::transaction(function () use ($id, $data) {
            $dto = UpdateSubscriptionData::fromArray($data);
            return $this->repository->update($id, $dto->toArray());
        });
    }
}