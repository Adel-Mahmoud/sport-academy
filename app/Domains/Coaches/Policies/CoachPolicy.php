<?php

namespace App\Domains\Coaches\Policies;

use App\Models\User as AuthUser;
use App\Domains\Coaches\Models\Coach;

class CoachPolicy
{
    public function view(AuthUser $user, Coach $model): bool
    {
        return true;
    }

    public function create(AuthUser $user): bool
    {
        return true;
    }

    public function update(AuthUser $user, Coach $model): bool
    {
        return true;
    }

    public function delete(AuthUser $user, Coach $model): bool
    {
        return true;
    }
}