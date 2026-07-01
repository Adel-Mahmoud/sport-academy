<?php

namespace App\Domains\Branches\Repositories;

use App\Domains\Branches\Models\Branch;

class BranchRepository
{
    public function all()
    {
        return Branch::all();
    }

    public function allActive()
    {
        return Branch::active()->get();
    }

    public function find(int $id)
    {
        return Branch::find($id);
    }

    public function create(array $data)
    {
        return Branch::create($data);
    }

    public function update(int $id, array $data)
    {
        $model = Branch::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id)
    {
        return Branch::destroy($id);
    }
}