<?php

namespace App\Domains\Coaches\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Domains\Coaches\Requests\StoreCoachRequest;
use App\Domains\Coaches\Requests\UpdateCoachRequest;
use App\Domains\Coaches\UseCases\GetCoachUseCase;
use App\Domains\Coaches\UseCases\RegisterCoachUseCase;
use App\Domains\Coaches\UseCases\UpdateCoachUseCase;

class CoachController extends Controller
{

    public function index(): View
    {
        $titlePage = 'المدربين';
        return view('coaches::admin.index', compact('titlePage'));
    }

    public function create(): View
    {
        $titlePage = 'مدرب جديد';
        $sectionPage = 'المدربين';
        return view('coaches::admin.create', compact('sectionPage', 'titlePage'));
    }


    public function store(
        StoreCoachRequest $request,
        RegisterCoachUseCase $useCase
    ) {
        $useCase->execute($request->validated());
        return redirect()
            ->route('admin.coaches.index')
            ->with('swal', [
                'type'  => 'success',
                'title' => 'تم الإضافة!',
                'text'  => 'تمت إضافة البيانات بنجاح.',
            ]);
    }


    public function edit(
        int $id,
        GetCoachUseCase $useCase
    ): View {
        $coach = $useCase->execute($id);
        $titlePage = 'تعديل بيانات المدرب';
        $sectionPage = 'المدربين';
        return view('coaches::admin.edit', compact('coach', 'sectionPage', 'titlePage'));
    }

    public function update(
        UpdateCoachRequest $request,
        int $id,
        UpdateCoachUseCase $useCase
    ) {
        $useCase->execute($id, $request->validated());

        return redirect()
            ->route('admin.coaches.index')
            ->with('swal', [
                'type'  => 'success',
                'title' => 'تم التعديل!',
                'text'  => 'تم تعديل البيانات بنجاح.',
            ]);
    }

}
