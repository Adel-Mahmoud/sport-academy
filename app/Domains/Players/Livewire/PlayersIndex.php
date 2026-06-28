<?php

namespace App\Domains\Players\Livewire;

use App\Domains\Players\Models\Player; 
use App\Livewire\BaseTableComponent;
use Illuminate\Support\Facades\Storage;

class PlayersIndex extends BaseTableComponent
{
    protected string $model = Player::class;

    protected $listeners = [
        'deleteItem'       => 'deleteItem',
        'deleteSelected'   => 'deleteSelected',
        'refreshComponent' => '$refresh',
    ];

    protected function beforeDelete($model): void
    {
        if ($model->image && Storage::disk('public')->exists($model->image)) {
            Storage::disk('public')->delete($model->image);
        }
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
