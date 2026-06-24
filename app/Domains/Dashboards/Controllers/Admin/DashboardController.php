<?php

namespace App\Domains\Dashboards\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Domains\Dashboards\Repositories\DashboardRepository;

class DashboardController extends Controller
{ 
    protected DashboardRepository $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
        // Permissions
        // $this->middleware('permission:view dashboard')->only(['index']);
    }
 
    public function index()
    {
        return view('dashboards::admin.index');
    }
}
