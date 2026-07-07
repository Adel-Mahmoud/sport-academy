<?php

namespace App\Domains\Subscriptions\Policies;

use App\Models\User as AuthUser;
use App\Domains\Subscriptions\Models\Subscription;

class SubscriptionPolicy
{
    public function view(AuthUser $user, Subscription $model): bool
    {
        return true;
    }

    public function create(AuthUser $user): bool
    {
        return true;
    }

    public function update(AuthUser $user, Subscription $model): bool
    {
        return true;
    }

    public function delete(AuthUser $user, Subscription $model): bool
    {
        return true;
    }
}