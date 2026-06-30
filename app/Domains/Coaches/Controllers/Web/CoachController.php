<?php

namespace App\Domains\Coaches\Controllers\Web;

use App\Http\Controllers\Controller;

class CoachController extends Controller
{
    public function index()
    {
        return view('coaches::web.index');
    }
}