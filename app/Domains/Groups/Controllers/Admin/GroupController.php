<?php

namespace App\Domains\Groups\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Domains\Groups\Requests\StoreGroupRequest;
use App\Domains\Groups\Requests\UpdateGroupRequest;
use App\Domains\Groups\UseCases\RegisterGroupUseCase;
use App\Domains\Groups\UseCases\UpdateGroupUseCase;
use App\Domains\Groups\Repositories\GroupRepository;
use App\Domains\Sports\Repositories\SportRepository;
use App\Domains\Groups\Actions\AddPlayersToGroupAction;
use App\Domains\Groups\Requests\AddPlayersToGroupRequest;
use App\Domains\Groups\Requests\TransferPlayersRequest;
use App\Domains\Groups\Actions\TransferPlayersAction;

class GroupController extends Controller
{
    public $groupRepository;
    public $sportRepository;
    public $titlePage = 'المجموعات';
    public $sectionPage = 'مجموعة';

    public function __construct(GroupRepository $groupRepository, SportRepository $sportRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->sportRepository = $sportRepository;
    }

    public function index(): View
    {
        $titlePage = $this->titlePage;
        return view('groups::admin.index', compact('titlePage'));
    }

    public function create(): View
    {
        $titlePage = 'إضافة ' . $this->titlePage . ' جديد';
        $sectionPage = $this->sectionPage;
        $sports = $this->sportRepository->all();
        return view('groups::admin.create', compact('sectionPage', 'titlePage', 'sports'));
    }

    public function store(
        StoreGroupRequest $request,
        RegisterGroupUseCase $useCase
    ) {
        $useCase->execute($request->validated());

        return redirect()
            ->route('admin.groups.index')
            ->with('swal', [
                'type' => 'success',
                'title' => 'تم الإضافة!',
                'text' => 'تمت إضافة البيانات بنجاح.',
            ]);
    }

    public function edit(
        int $id,
    ): View {
        $group = $this->groupRepository->find($id);
        $titlePage = 'تعديل ' . $this->titlePage;
        $sectionPage = $this->sectionPage;
        $sports = $this->sportRepository->all();
        return view('groups::admin.edit', compact('group', 'sectionPage', 'titlePage', 'sports'));
    }

    public function update(
        UpdateGroupRequest $request,
        int $id,
        UpdateGroupUseCase $useCase
    ) {
        $useCase->execute($id, $request->validated());

        return redirect()
            ->route('admin.groups.index')
            ->with('swal', [
                'type' => 'success',
                'title' => 'تم التعديل!',
                'text' => 'تم تعديل البيانات بنجاح.',
            ]);
    }

    public function manage(int $id): View
    {
        $titlePage = $this->sectionPage . ' - إدارة اللاعبين والمدربين';
        $sectionPage = $this->sectionPage;
        $group = $this->groupRepository->find($id);
        return view('groups::admin.manage', compact('id', 'group', 'titlePage', 'sectionPage'));
    }



    public function addPlayersToGroup(
        AddPlayersToGroupRequest $request,
        AddPlayersToGroupAction $action
    ) {
        $data = $request->validated();

        $action->handle($data['group_id'], $data['player_ids']);
        return redirect()->back()->with('swal', [
            'type'  => 'success',
            'title' => 'تم الإضافة!',
            'text'  => 'تم إضافة اللاعبين بنجاح للمجموعة.',
        ]);
    }

    public function transferPlayers(
        TransferPlayersRequest $request,
        TransferPlayersAction $action
    ) {
        $data = $request->validated();

        $action->handle(
            $data['from_group_id'],
            $data['target_group_id'],
            $data['player_ids']
        );

        return redirect()->back()->with('swal', [
            'type'  => 'success',
            'title' => 'تم نقل اللاعبين!',
            'text'  => 'تم نقل اللاعبين المحددين إلى المجموعة الجديدة بنجاح.',
        ]);
    }
}
