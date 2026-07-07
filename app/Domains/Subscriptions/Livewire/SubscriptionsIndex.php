<?php

namespace App\Domains\Subscriptions\Livewire;

use App\Livewire\BaseTableComponent;

class SubscriptionsIndex extends BaseTableComponent
{
    protected string $model = \App\Domains\Subscriptions\Models\Subscription::class;

    protected $listeners = [
        'deleteItem' => 'deleteItem',
        'deleteSelected' => 'deleteSelected',
        'refreshComponent' => '$refresh',
    ];

    public function render()
    {
        $subscriptions = $this->model::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->paginate(10);

        return view('subscriptions::livewire.subscriptions-index', compact('subscriptions'));
    }
}