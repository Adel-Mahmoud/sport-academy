<?php

namespace App\Domains\Groups\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Domains\Groups\Requests\StoreGroupRequest;
use App\Domains\Groups\Requests\UpdateGroupRequest;
use App\Domains\Groups\UseCases\RegisterGroupUseCase;
use App\Domains\Groups\UseCases\UpdateGroupUseCase;
use App\Domains\Groups\Repositories\GroupRepository;

class GroupController extends Controller
{
    public $groupRepository;
    public $titlePage = 'المجموعات';
    public $sectionPage = 'مجموعة';

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }
    
    public function index(): View
    {
        $titlePage = $this->titlePage;
        return view('groups::admin.index', compact('titlePage'));
    }

    public function create(): View
    {
        $titlePage = 'إضافة '.$this->titlePage.' جديد';
        $sectionPage = $this->sectionPage;
        $sports = $this->groupRepository->getSports();
        $branches = $this->groupRepository->getBranches();
        return view('groups::admin.create', compact('sectionPage', 'titlePage', 'sports', 'branches'));
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
        $titlePage = 'تعديل '.$this->titlePage;
        $sectionPage = $this->sectionPage;
        $sports = $this->groupRepository->getSports();
        $branches = $this->groupRepository->getBranches();
        return view('groups::admin.edit', compact('group', 'sectionPage', 'titlePage', 'sports', 'branches'));
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
}