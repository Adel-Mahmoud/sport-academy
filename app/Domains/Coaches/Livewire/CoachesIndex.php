<?php

namespace App\Domains\Coaches\Livewire;

use App\Livewire\BaseTableComponent;


class CoachesIndex extends BaseTableComponent
{
    protected string $model = \App\Domains\Coaches\Models\Coach::class;

    protected $listeners = [
        'deleteItem'       => 'deleteItem',
        'deleteSelected'   => 'deleteSelected',
        'refreshComponent' => '$refresh',
    ];

    protected function beforeDelete($coach): bool
    {
        $coach->user->delete();
        return true;
    }

    public function render()
    {
        $coaches = $this->model::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%"); 
            })
            ->paginate(10);

        return view('coaches::livewire.coaches-index', compact('coaches'));
    }
}