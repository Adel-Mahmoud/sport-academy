<?php

namespace App\Domains\Groups\Controllers\Web;

use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function index()
    {
        return view('groups::web.index');
    }
}