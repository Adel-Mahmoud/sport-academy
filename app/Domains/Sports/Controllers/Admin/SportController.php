<?php

namespace App\Domains\Sports\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Domains\Sports\Requests\SportRequest; 
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Domains\Branches\Repositories\BranchRepository;
use App\Domains\Sports\UseCases\RegisterSportUseCase;
use App\Domains\Sports\UseCases\UpdateSportUseCase;
use App\Domains\Sports\UseCases\GetSportUseCase;
use App\Domains\Sports\DTOs\CreateSportData;

class SportController extends Controller
{
    protected BranchRepository $branchRepository;

    public function __construct(BranchRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
        // Permissions
        // $this->middleware('permission:view sports')->only(['index']);
        // $this->middleware('permission:create sport')->only(['create', 'store']);
        // $this->middleware('permission:edit sport')->only(['edit', 'update']);
        // $this->middleware('permission:delete sport')->only(['destroy']);
    }

    public function index(): View
    {
        $titlePage = 'الرياضات';
        return view('sports::admin.index', compact('titlePage'));
    }

    public function create(): View
    {
        $sectionPage = 'الرياضات';
        $titlePage = 'رياضة جديدة';
        $branches = $this->branchRepository->allActive();
        return view('sports::admin.create', compact('sectionPage', 'titlePage', 'branches'));
    }

    public function store(SportRequest $request, RegisterSportUseCase $registerSportUseCase): RedirectResponse
    {
        $sportData = CreateSportData::fromArray($request->validated());
        $registerSportUseCase->execute($sportData->toArray());

        return redirect()
            ->route('admin.sports.index')
            ->with('swal', [
                'type'  => 'success',
                'title' => 'تم الإضافة!',
                'text'  => 'تمت إضافة الرياضة بنجاح.',
            ]);
    }

    public function edit($id): View
    {
        $sectionPage = 'الرياضات';
        $titlePage = 'تعديل رياضة';
        $getSportUseCase = app(GetSportUseCase::class);
        $sport = $getSportUseCase->execute($id);
        $branches = $this->branchRepository->allActive();
        return view('sports::admin.edit', compact('sport', 'sectionPage', 'titlePage', 'branches'));
    }

    public function update(SportRequest $request, $id, UpdateSportUseCase $updateSportUseCase): RedirectResponse
    {
        $updateSportUseCase->execute($id, $request->validated());

        return redirect()
            ->route('admin.sports.index')
            ->with('success', 'تم تعديل الرياضة بنجاح');
    }
}
