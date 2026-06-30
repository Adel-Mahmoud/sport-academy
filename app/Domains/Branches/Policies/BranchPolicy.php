<?php

namespace App\Domains\Branches\Policies;

use App\Models\User as AuthUser;
use App\Domains\Branches\Models\Branch;

class BranchPolicy
{
    public function view(AuthUser $user, Branch $model): bool
    {
        return true;
    }

    public function create(AuthUser $user): bool
    {
        return true;
    }

    public function update(AuthUser $user, Branch $model): bool
    {
        return true;
    }

    public function delete(AuthUser $user, Branch $model): bool
    {
        return true;
    }
}