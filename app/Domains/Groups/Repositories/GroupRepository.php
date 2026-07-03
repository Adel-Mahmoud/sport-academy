<?php

namespace App\Domains\Groups\Repositories;

use App\Domains\Groups\Models\Group;

class GroupRepository
{
    public function all()
    {
        return Group::latest()->paginate(20);
    }

    public function getSports()
    {
        return Group::select('sport_id')->distinct()->get();
    }

    public function getPlayers(int $groupId)
    {
        return Group::findOrFail($groupId)->players()->paginate(20);
    }

    public function getCoaches(int $groupId)
    {
        return Group::findOrFail($groupId)->coaches()->paginate(20);
    }
    
    // public function getBranches()
    // {
    //     return Group::select('branch_id')->distinct()->get();
    // }

    public function find(int $id): ?Group
    {
        return Group::with(['sport'])->find($id);
    }

    public function create(array $data): Group
    {
        return Group::create($data);
    }

    public function update(int $id, array $data): Group
    {
        $group = Group::findOrFail($id);
        $group->update($data);
        return $group;
    }

    public function delete(int $id): void
    {
        Group::destroy($id);
    }

}