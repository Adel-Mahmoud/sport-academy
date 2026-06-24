<?php

namespace App\Domains\Sports\Controllers\Web;

use App\Http\Controllers\Controller;

class SportController extends Controller
{
    public function index()
    {
        return view('sports::web.index');
    }
}