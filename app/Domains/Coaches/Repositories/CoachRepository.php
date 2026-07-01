<?php

namespace App\Domains\Coaches\Repositories;

use App\Domains\Coaches\Models\Coach;

class CoachRepository
{
    public function all()
    {
        return Coach::all();
    }

    public function find(int $id)
    {
        return Coach::with('user')->find($id);
    }

    public function create(array $data)
    {
        return Coach::create($data);
    }

    public function update(int $id, array $data)
    {
        $model = Coach::with('user')->findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id)
    {
        return Coach::destroy($id);
    }
}