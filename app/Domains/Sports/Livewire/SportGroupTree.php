<?php

namespace App\Domains\Sports\Livewire;

use Livewire\Component;
use App\Domains\Sports\Models\Sport;

class SportGroupTree extends Component
{
    public array $selectedSports = [];
    public array $selectedGroups = [];
    public array $expandedSports = []; 

    public function mount(array $oldSports = [], array $oldGroups = [])
    {
        $this->selectedSports = old('sports', $oldSports);
        $this->selectedGroups = old('groups', $oldGroups);
    }

    public function toggleExpand(int $sportId)
    {
        if (in_array($sportId, $this->expandedSports)) {
            $this->expandedSports = array_diff($this->expandedSports, [$sportId]);
        } else {
            $this->expandedSports[] = $sportId;
        }
    }

    public function updatedSelectedSports()
    {
        $sports = Sport::with('groups')->whereIn('id', $this->selectedSports)->get();
        
        $allGroupIds = [];
        foreach ($sports as $sport) {
            foreach ($sport->groups as $group) {
                $allGroupIds[] = (string) $group->id;
            }
        }

        // تحديد كل المجموعات التابعة للعبات المختارة
        $this->selectedGroups = array_unique($allGroupIds);
    }

    // عند تحديد/إلغاء تحديد مجموعة معينة
    public function updatedSelectedGroups()
    {
        // تحديث اللعبات بناءً على المجموعات المحددة (اختياري حسب منطق العمل لديكم)
    }

    public function render()
    {
        $sports = Sport::with('groups')->get();
        return view('sports::livewire.sport-group-tree', [
            'sports' => $sports
        ]);
    }
}