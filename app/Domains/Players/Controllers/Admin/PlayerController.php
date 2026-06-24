<?php

namespace App\Domains\Players\Controllers\Admin;

use App\Domains\Players\Services\PlayerService;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PlayerController extends Controller
{
    public function __construct(
        private readonly PlayerService $service,
    ) {
    }

    public function index(): View
    {
        $players = $this->service->all();

        return view('players::admin.index', compact('players'));
    }
}