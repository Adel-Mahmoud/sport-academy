<?php

namespace App\Domains\Branches\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Domains\Branches\Requests\StoreBranchRequest;
use App\Domains\Branches\Requests\UpdateBranchRequest;
use App\Domains\Branches\UseCases\GetBranchUseCase;
use App\Domains\Branches\UseCases\RegisterBranchUseCase;
use App\Domains\Branches\UseCases\UpdateBranchUseCase;

class BranchController extends Controller
{
    public function index(): View
    {
        $titlePage = 'Branches';
        return view('branches::admin.index', compact('titlePage'));
    }

    public function create(): View
    {
        $titlePage = 'إضافة Branch جديد';
        $sectionPage = 'Branches';
        return view('branches::admin.create', compact('sectionPage', 'titlePage'));
    }

    public function store(
        StoreBranchRequest $request,
        RegisterBranchUseCase $useCase
    ) {
        $useCase->execute($request->validated());

        return redirect()
            ->route('admin.branches.index')
            ->with('swal', [
                'type' => 'success',
                'title' => 'تم الإضافة!',
                'text' => 'تمت إضافة البيانات بنجاح.',
            ]);
    }

    public function edit(
        int $id,
        GetBranchUseCase $useCase
    ): View {
        $branch = $useCase->execute($id);
        $titlePage = 'تعديل Branch';
        $sectionPage = 'Branches';
        return view('branches::admin.edit', compact('branch', 'sectionPage', 'titlePage'));
    }

    public function update(
        UpdateBranchRequest $request,
        int $id,
        UpdateBranchUseCase $useCase
    ) {
        $useCase->execute($id, $request->validated());

        return redirect()
            ->route('admin.branches.index')
            ->with('swal', [
                'type' => 'success',
                'title' => 'تم التعديل!',
                'text' => 'تم تعديل البيانات بنجاح.',
            ]);
    }
}