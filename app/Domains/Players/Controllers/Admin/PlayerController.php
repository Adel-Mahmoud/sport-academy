<?php

namespace App\Domains\Players\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Domains\Players\Requests\StorePlayerRequest;
use App\Domains\Players\Actions\CreatePlayerAction;

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

    public function store(StorePlayerRequest $request, CreatePlayerAction $createPlayerAction)
    {
        $createPlayerAction->execute($request->validated());

        return redirect()
            ->route('admin.players.index')
            ->with('swal', [
                'type'  => 'success',
                'title' => 'تم الإضافة!',
                'text'  => 'تمت إضافة البيانات بنجاح.',
            ]);
    }
}
