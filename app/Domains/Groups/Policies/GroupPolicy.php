<?php

namespace App\Domains\Groups\Policies;

use App\Models\User as AuthUser;
use App\Domains\Groups\Models\Group;

class GroupPolicy
{
    public function view(AuthUser $user, Group $model): bool
    {
        return true;
    }

    public function create(AuthUser $user): bool
    {
        return true;
    }

    public function update(AuthUser $user, Group $model): bool
    {
        return true;
    }

    public function delete(AuthUser $user, Group $model): bool
    {
        return true;
    }
}