<?php

namespace App\Domains\Users\Livewire;

use App\Domains\Auth\Models\Admin;
use App\Livewire\BaseTableComponent;

class UserIndex extends BaseTableComponent
{
    protected string $model = Admin::class;

    protected $listeners = [
        'deleteItem' => 'deleteItem',
        'deleteSelected' => 'deleteSelected',
        'refreshComponent' => '$refresh',
    ];

    public function deleteItem($id): void
    {
        if (auth('admin')->id() == $id) {

            $this->dispatch('swal:error', [
                'title' => 'خطأ',
                'text' => 'لا يمكنك حذف نفسك',
            ]);

            return;
        }

        parent::deleteItem($id);
    }

    public function deleteSelected(): void
    {
        $this->selected = collect($this->selected)
            ->reject(fn ($id) => $id == auth('admin')->id())
            ->values()
            ->toArray();

        parent::deleteSelected();
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