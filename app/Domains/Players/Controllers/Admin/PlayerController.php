<?php

namespace App\Domains\Players\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Shared\Services\ImageService;
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

    public function store(
        StorePlayerRequest $request,
        RegisterPlayerUseCase $useCase,
        ImageService $imageService
    ) {
        $player = $useCase->execute($request->validated());

        if ($request->hasFile('image')) {
            $imageService->store(
                $player,
                $request->file('image'),
                'players'
            );
        }
        return redirect()
            ->route('admin.players.index')
            ->with('swal', [
                'type'  => 'success',
                'title' => 'تم الإضافة!',
                'text'  => 'تمت إضافة البيانات بنجاح.',
            ]);
    }
    /*
        \\\ on update player
        if ($request->hasFile('image')) {
            $imageService->update(
                $player,
                $request->file('image'),
                'players'
            );
        }
        \\\\\ on delete player
        $imageService->delete($player);
        $player->delete();    
     */
}
