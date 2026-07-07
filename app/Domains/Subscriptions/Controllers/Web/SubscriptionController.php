<?php

namespace App\Domains\Subscriptions\Controllers\Web;

use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscriptions::web.index');
    }
}