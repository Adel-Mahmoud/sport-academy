<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseTableComponent extends Component
{
    use WithPagination;

    public string $search = '';

    public array $selected = [];

    public bool $selectAll = false;

    protected $paginationTheme = 'bootstrap';

    protected string $model;

    protected int $perPage = 10;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    protected function beforeDelete($model): bool
    {
        return true;
    }

    public function deleteItem($id): void
    {
        $model = $this->model::findOrFail($id);

        if (!$this->beforeDelete($model)) {
            return;
        }

        if (method_exists($this, 'handleDelete')) {
            $this->handleDelete($model);
        }

        if (method_exists($model, 'beforeDelete')) {
            $model->beforeDelete();
        }

        $model->delete();

        if (method_exists($model, 'afterDelete')) {
            $model->afterDelete();
        }

        $this->dispatch('swal:success', [
            'title' => 'تم الحذف!',
            'text'  => 'تم حذف البيانات بنجاح.',
        ]);

        $this->dispatch('refreshComponent');
    }

    public function updatedSelectAll($value): void
    {
        $this->selected = $value
            ? $this->model::pluck('id')->toArray()
            : [];
    }

    public function confirmDelete($id): void
    {
        $this->dispatch('swal:confirm', [
            'id'    => $id,
            'title' => 'هل أنت متأكد؟',
            'text'  => 'لن يمكنك التراجع بعد الحذف!',
            'type'  => 'single',
        ]);
    }

    public function confirmDeleteSelected(): void
    {
        if (empty($this->selected)) {

            $this->dispatch('swal:error', [
                'title' => 'لم يتم التحديد',
                'text'  => 'يرجى تحديد عناصر للحذف أولاً.',
            ]);

            return;
        }

        $this->dispatch('swal:confirm', [
            'type'  => 'bulk',
            'title' => 'هل أنت متأكد؟',
            'text'  => 'سيتم حذف ' . count($this->selected) . ' عنصر.',
        ]);
    }

    public function deleteSelected(): void
    {
        if (empty($this->selected)) {
            return;
        }

        $models = $this->model::whereIn('id', $this->selected)->with('player')->get();

        foreach ($models as $model) {

            if (!$this->beforeDelete($model)) {
                continue;
            }

            $player = $model->player; 

            if (method_exists($this, 'handleDelete')) {
                $this->handleDelete($model, $player);
            }

            $model->delete();

            if (method_exists($model, 'afterDelete')) {
                $model->afterDelete();
            }
        }

        $this->selected = [];
        $this->selectAll = false;

        $this->dispatch('swal:success', [
            'title' => 'تم الحذف',
            'text'  => 'تم حذف العناصر المحددة بنجاح',
        ]);

        $this->dispatch('refreshComponent');
    }
}
