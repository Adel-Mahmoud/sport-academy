<?php

namespace App\Domains\Players\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Domains\Players\Requests\StorePlayerRequest;
use App\Domains\Players\UseCases\RegisterPlayerUseCase;

class PlayerController extends Controller
{
    public function index(): View
    {
        $titlePage = 'اللاعبين';
        return view('players::admin.index', compact('titlePage'));
    }

    public function create(): View
    {
        $titlePage = 'لاعب جديد';
        $sectionPage = 'اللاعبين';
        return view('players::admin.create', compact('sectionPage', 'titlePage'));
    }

    public function store(StorePlayerRequest $request, RegisterPlayerUseCase $useCase)
    {
        $data = $request->validated();

        $tempPath = null;

        if ($request->hasFile('image')) {
            $tempPath = $request->file('image')->store('temp', 'public');
        }

        $useCase->execute($data, $tempPath);
        
        return redirect()
            ->route('admin.players.index')
            ->with('swal', [
                'type'  => 'success',
                'title' => 'تم الإضافة!',
                'text'  => 'تمت إضافة البيانات بنجاح.',
            ]);
    }
}
