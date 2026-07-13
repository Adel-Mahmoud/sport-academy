<?php

namespace App\Domains\Groups\Livewire;

use Livewire\Component;
use App\Domains\Groups\Actions\GetGroupPlayersAction;
use App\Domains\Groups\Actions\GetAvailablePlayersAction;

class GroupManager extends Component
{
    protected GetGroupPlayersAction $getGroupPlayers;
    protected GetAvailablePlayersAction $getAvailablePlayers;

    public function boot(
        GetGroupPlayersAction $getGroupPlayers,
        GetAvailablePlayersAction $getAvailablePlayers
    ) {
        $this->getGroupPlayers = $getGroupPlayers;
        $this->getAvailablePlayers = $getAvailablePlayers;
    }

    public function render()
    {
        return view('groups::livewire.groups-manager', [
            'coaches' => $this->coachesRepository->getActive(),
            'currentPlayers' => $this->getGroupPlayers->handle($this->groupId),
            'availablePlayers' => $this->getAvailablePlayers->handle($this->groupId),
        ]);
    }
}
