<?php

namespace App\Domains\Sports\Livewire;

use App\Domains\Sports\Models\Sport; 
use App\Livewire\BaseTableComponent;

class SportsIndex extends BaseTableComponent
{

    protected string $model = Sport::class;

    protected $listeners = [
        'deleteItem'     => 'deleteItem',
        'deleteSelected' => 'deleteSelected',
        'refreshComponent' => '$refresh',
    ];

    public function render()
    {
        $sports = $this->model::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%"); 
            })
            ->with('branch')
            ->paginate(10);

        return view('sports::livewire.sports-index', compact('sports'));
    }
}
