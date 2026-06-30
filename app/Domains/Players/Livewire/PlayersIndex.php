<?php

namespace App\Domains\Players\Livewire;

use App\Domains\Players\Models\Player; 
use App\Livewire\BaseTableComponent;
use App\Domains\Players\Services\PlayerDeleteService;

class PlayersIndex extends BaseTableComponent
{
    protected string $model = Player::class;

    protected PlayerDeleteService $deleteService;

    protected $listeners = [
        'deleteItem'       => 'deleteItem',
        'deleteSelected'   => 'deleteSelected',
        'refreshComponent' => '$refresh',
    ];

    public function boot(PlayerDeleteService $deleteService): void
    {
        $this->deleteService = $deleteService;
    }

    protected function beforeDelete($player): bool
    {
        $this->deleteService->delete($player);
        $player->user->delete();
        return true;
    }
    
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
