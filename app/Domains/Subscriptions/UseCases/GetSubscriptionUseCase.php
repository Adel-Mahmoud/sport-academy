<?php

namespace App\Domains\Subscriptions\UseCases;

use App\Domains\Subscriptions\Models\Subscription;
use App\Domains\Subscriptions\Repositories\SubscriptionRepository;

class GetSubscriptionUseCase
{
    public function __construct(
        protected SubscriptionRepository $repository
    ) {}

    public function execute(int $id): Subscription
    {
        return $this->repository->find($id);
    }
}