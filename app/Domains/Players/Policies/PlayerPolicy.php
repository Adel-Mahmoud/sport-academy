<?php

namespace App\Domains\Players\Policies;

use App\Models\User as AuthUser;
use App\Domains\Players\Models\Player;

class PlayerPolicy
{
    public function view(AuthUser $user, Player $model): bool
    {
        return true;
    }

    public function create(AuthUser $user): bool
    {
        return true;
    }

    public function update(AuthUser $user, Player $model): bool
    {
        return true;
    }

    public function delete(AuthUser $user, Player $model): bool
    {
        return true;
    }
}