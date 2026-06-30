<?php

namespace App\Domains\Branches\Controllers\Web;

use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function index()
    {
        return view('branches::web.index');
    }
}