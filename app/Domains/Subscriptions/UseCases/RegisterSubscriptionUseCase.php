<?php

namespace App\Domains\Subscriptions\UseCases;

use Illuminate\Support\Facades\DB;
use App\Domains\Subscriptions\Models\Subscription;
use App\Domains\Subscriptions\DTOs\CreateSubscriptionData;
use App\Domains\Subscriptions\Repositories\SubscriptionRepository;

class RegisterSubscriptionUseCase
{
    public function __construct(
        protected SubscriptionRepository $repository
    ) {}

    public function execute(array $data): Subscription
    {
        return DB::transaction(function () use ($data) {
            $dto = CreateSubscriptionData::fromArray($data);
            return $this->repository->create($dto->toArray());
        });
    }
}