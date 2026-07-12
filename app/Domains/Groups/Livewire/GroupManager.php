<?php

namespace App\Domains\Groups\Livewire;

use Livewire\Component;
use App\Domains\Coaches\Repositories\CoachRepository;
use App\Domains\Players\Repositories\PlayerRepository;
use App\Domains\Groups\Repositories\GroupRepository;


class GroupManager extends Component
{
    public array $selectedPlayers = [];

    public ?int $targetGroupId = null;

    public int $groupId;

    public CoachRepository $coachRepository;

    public PlayerRepository $playerRepository;

    protected GroupRepository $groupRepository;

    public function mount(
        int $groupId,
        CoachRepository $coachRepository,
        PlayerRepository $playerRepository,
        GroupRepository $groupRepository
    ) {
        $this->groupId = $groupId;

        $this->coachesRepository = $coachRepository;
        $this->playerRepository = $playerRepository;
        $this->groupRepository = $groupRepository;

        $this->groups = $groupRepository->all();

        // التحديد الافتراضي
        $this->targetGroupId = $groupId;
    }
    public function render()
    {
        $coaches = $this->coachesRepository->getActive();
        $players = $this->playerRepository->getActive();
        return view('groups::livewire.groups-manager', [
            'coaches' => $coaches,
            'players' => $players
        ]);
    }
}
