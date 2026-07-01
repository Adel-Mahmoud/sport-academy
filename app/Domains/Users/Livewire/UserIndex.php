<?php

namespace App\Domains\Users\Livewire;

use App\Domains\Users\Models\User;
use App\Livewire\BaseTableComponent;
use App\Domains\Players\Services\PlayerDeleteService;

class UserIndex extends BaseTableComponent
{
    protected string $model = User::class;

    protected PlayerDeleteService $deleteService;

    protected $listeners = [
        'deleteItem' => 'deleteItem',
        'deleteSelected' => 'deleteSelected',
        'refreshComponent' => '$refresh',
    ];

    public function boot(PlayerDeleteService $deleteService): void
    {
        $this->deleteService = $deleteService;
    }

    protected function beforeDelete($model): bool
    {
        if (auth()->id() == $model->id) {

            $this->dispatch('swal:error', [
                'title' => 'خطأ',
                'text' => 'لا يمكنك حذف نفسك',
            ]);

            return false;
        }
        if ($model->player && $model->player->image) {
            $this->deleteService->delete($model->player);
        }
        return true;
    }

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
