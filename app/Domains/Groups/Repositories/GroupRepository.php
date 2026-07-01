<?php

namespace App\Domains\Groups\Repositories;

use App\Domains\Groups\Models\Group;

class GroupRepository
{
    public function all()
    {
        return Group::all();
    }

    public function find(int $id)
    {
        return Group::find($id);
    }

    public function create(array $data)
    {
        return Group::create($data);
    }

    public function update(int $id, array $data)
    {
        $model = Group::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id)
    {
        return Group::destroy($id);
    }
}