<?php

namespace App\Domains\Groups\Livewire;

use Livewire\Component;
use App\Domains\Groups\Models\Group;

class CoachesGroup extends Component
{
    public Group $group;

    public function mount(Group $group): void
    {
        $this->group = $group;
    }

    public function render()
    {
        return view('groups::livewire.groups-group');
    }
}