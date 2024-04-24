<?php

namespace App\Http\Controllers;

use App\Models\Expens;
use App\Models\Subscription;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      
    }
}
