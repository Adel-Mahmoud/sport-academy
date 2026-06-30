<?php

namespace App\Domains\Groups\Controllers\Admin;

use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function index()
    {
        return view('groups::admin.index');
    }
}