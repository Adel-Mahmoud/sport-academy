<?php

namespace App\Domains\Sports\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Domains\Sports\Requests\SportRequest; 
use App\Domains\Sports\Models\Sport;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SportController extends Controller
{
    public function __construct()
    {        
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
        return view('sports::admin.create', compact('sectionPage', 'titlePage'));
    }

    public function store(SportRequest $request): RedirectResponse
    {
        Sport::create($request->validated());

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
        $sport = Sport::find($id);
        
        return view('sports::admin.edit', compact('sport', 'sectionPage', 'titlePage'));
    }

    public function update(SportRequest $request, $id): RedirectResponse
    {
        Sport::update($id, $request->validated());
        
        return redirect()
            ->route('admin.sports.index')
            ->with('success', 'تم تعديل الرياضة بنجاح');
    }

    public function destroy($id): RedirectResponse
    {
        Sport::delete($id);
        
        return redirect()
            ->route('admin.sports.index')
            ->with('success', 'تم حذف الرياضة بنجاح');
    }
}
