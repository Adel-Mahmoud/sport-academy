<?php

namespace App\Domains\Groups\Livewire;

use Livewire\Component;
use App\Domains\Groups\Actions\GetGroupCoachesAction;
use App\Domains\Groups\Actions\GetGroupPlayersAction;
use App\Domains\Groups\Actions\GetAvailablePlayersAction;
use App\Domains\Groups\Actions\GetOtherGroupsInSameSportAction;

class GroupManager extends Component
{
    public $groupId;
    
    public function mount($id) {
        $this->groupId = $id;
    }

    public function render(
        GetGroupCoachesAction $getGroupCoaches,
        GetGroupPlayersAction $getGroupPlayers,
        GetAvailablePlayersAction $getAvailablePlayers,
        GetOtherGroupsInSameSportAction $getOtherGroupsInSameSport,
    )
    {
        return view('groups::livewire.groups-manager', [
            'groupId' => $this->groupId,
            'coaches' => $getGroupCoaches->handle($this->groupId),
            'currentPlayers' => $getGroupPlayers->handle($this->groupId),
            'availablePlayers' => $getAvailablePlayers->handle($this->groupId),
            'getOtherGroupsInSameSport' => $getOtherGroupsInSameSport->handle($this->groupId),
        ]);
    }
}
