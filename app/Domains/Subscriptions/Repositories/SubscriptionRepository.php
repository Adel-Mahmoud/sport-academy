<?php

namespace App\Domains\Subscriptions\Repositories;

use App\Domains\Subscriptions\Models\Subscription;

class SubscriptionRepository
{
    public function all()
    {
        return Subscription::all();
    }

    public function find(int $id)
    {
        return Subscription::find($id);
    }

    public function create(array $data)
    {
        return Subscription::create($data);
    }

    public function update(int $id, array $data)
    {
        $model = Subscription::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id)
    {
        return Subscription::destroy($id);
    }
}