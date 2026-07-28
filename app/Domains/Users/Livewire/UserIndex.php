<?php

namespace App\Domains\Users\Livewire;

use App\Domains\Users\Models\User;
use App\Livewire\BaseTableComponent;

class UserIndex extends BaseTableComponent
{
    protected string $model = User::class;


    protected $listeners = [
        'deleteItem' => 'deleteItem',
        'deleteSelected' => 'deleteSelected',
        'refreshComponent' => '$refresh',
    ];

    public function render()
    {
        $users = $this->model::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->paginate(10);

        return view('users::livewire.user-index', compact('users'));
    }
}
