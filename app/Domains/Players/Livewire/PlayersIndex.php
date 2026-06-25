<?php

namespace App\Domains\Players\Livewire;

use App\Domains\Players\Models\Player; 
use App\Livewire\BaseTableComponent;

class PlayersIndex extends BaseTableComponent
{
    protected string $model = Player::class;

    protected $listeners = [
        'deleteItem'       => 'deleteItem',
        'deleteSelected'   => 'deleteSelected',
        'refreshComponent' => '$refresh',
    ];

    public function render()
    {
        $players = $this->model::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%"); 
            })
            ->paginate(10);

        return view('players::livewire.players-index', compact('players'));
    }
}
