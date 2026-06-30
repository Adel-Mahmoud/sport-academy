<?php

namespace App\Domains\Branches\Livewire;

use App\Livewire\BaseTableComponent;

class BranchesIndex extends BaseTableComponent
{
    protected string $model = \App\Domains\Branches\Models\Branch::class;

    protected $listeners = [
        'deleteItem' => 'deleteItem',
        'deleteSelected' => 'deleteSelected',
        'refreshComponent' => '$refresh',
    ];

    public function render()
    {
        $branches = $this->model::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->paginate(10);

        return view('branches::livewire.branches-index', compact('branches'));
    }
}