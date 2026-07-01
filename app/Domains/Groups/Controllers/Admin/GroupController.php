<?php

namespace App\Domains\Groups\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Domains\Groups\Requests\StoreGroupRequest;
use App\Domains\Groups\Requests\UpdateGroupRequest;
use App\Domains\Groups\UseCases\GetGroupUseCase;
use App\Domains\Groups\UseCases\RegisterGroupUseCase;
use App\Domains\Groups\UseCases\UpdateGroupUseCase;

class GroupController extends Controller
{
    public $titlePage = 'المجموعات';
    public $sectionPage = 'مجموعة';

    public function index(): View
    {
        $titlePage = $this->titlePage;
        return view('groups::admin.index', compact('titlePage'));
    }

    public function create(): View
    {
        $titlePage = 'إضافة '.$this->titlePage.' جديد';
        $sectionPage = $this->sectionPage;
        return view('groups::admin.create', compact('sectionPage', 'titlePage'));
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
        GetGroupUseCase $useCase
    ): View {
        $group = $useCase->execute($id);
        $titlePage = 'تعديل '.$this->titlePage;
        $sectionPage = $this->sectionPage;
        return view('groups::admin.edit', compact('group', 'sectionPage', 'titlePage'));
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