<?php

namespace App\Domains\Settings\Controllers\Web;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings::web.index');
    }
}