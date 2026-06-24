<?php

namespace App\Domains\Dashboards\Controllers\Web;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboards::web.index');
    }
}