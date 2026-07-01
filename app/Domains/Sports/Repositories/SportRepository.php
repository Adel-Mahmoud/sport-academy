<?php

namespace App\Domains\Sports\Repositories;

use App\Domains\Sports\Models\Sport;

class SportRepository
{
    public function all()
    {
        return Sport::all();
    }

    public function find(int $id)
    {
        return Sport::find($id);
    }

    public function create(array $data)
    {
        return Sport::create($data);
    }

    public function update(int $id, array $data)
    {
        $model = Sport::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id)
    {
        return Sport::destroy($id);
    }
}