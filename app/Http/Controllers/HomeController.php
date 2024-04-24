<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coach;
use App\Models\Player;
use App\Models\Sport;
use App\Models\Expens;
use App\Models\Subscription;

class HomeController extends Controller
{
    public static $remaining_amount;
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usersCount = User::count(); 
        $playerCount = Player::count(); 
        $coachesCount = Coach::count(); 
        ///////////////////////////
        $currentYear = date('Y');
        $currentMonth = date('m');
        ///////////////////////////
        $sports = Sport::with(['players.subscriptions' => function ($query) use ($currentYear, $currentMonth) {
            $query->whereYear('subscriptions.created_at', $currentYear)
                ->whereMonth('subscriptions.created_at', $currentMonth);
        }])->get();
        
        $subscribe = Subscription::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)->sum('subscribe');
        $totalExpens = Expens::whereYear('created_at', $currentYear)
              ->whereMonth('created_at', $currentMonth)->sum('expens');
        return view('home', compact('usersCount','playerCount','coachesCount','sports','totalExpens','subscribe'));
    }
    
    public static function getRemainingAmount()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');
        $subscribe = Subscription::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)->sum('subscribe');
        self::$remaining_amount = $subscribe;
        return self::$remaining_amount;
    }
}
