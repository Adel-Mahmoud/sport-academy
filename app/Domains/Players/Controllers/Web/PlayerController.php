<?php

namespace App\Domains\Players\Controllers\Web;

use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    public function index()
    {
        return view('players::web.index');
    }
}