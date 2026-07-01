<?php

namespace App\Domains\Groups\Livewire;

use App\Livewire\BaseTableComponent;

class GroupsIndex extends BaseTableComponent
{
    protected string $model = \App\Domains\Groups\Models\Group::class;

    protected $listeners = [
        'deleteItem' => 'deleteItem',
        'deleteSelected' => 'deleteSelected',
        'refreshComponent' => '$refresh',
    ];

    public function render()
    {
        $groups = $this->model::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->paginate(10);

        return view('groups::livewire.groups-index', compact('groups'));
    }
}