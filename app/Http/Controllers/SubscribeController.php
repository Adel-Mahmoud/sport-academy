<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Sport;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /*
        $players = Player::paginate(5); 
        $sports  = Sport::all(); 
        $subscription = Subscription::paginate(5); 
        return view('subscription.index', compact('subscription','players','sports'));
        */
    }
    
    public function OldSubscription(){
      $currentYear = date('Y');
      $currentMonth = date('m');
      $data = Subscription::where(function ($query) use ($currentYear, $currentMonth) {
        $query->whereYear('created_at', '<>', $currentYear)
          ->orWhere(function ($query) use ($currentYear, $currentMonth) {
            $query->whereYear('created_at', '<>', $currentYear)
                ->orWhere(function ($query) use ($currentMonth) {
                    $query->whereMonth('created_at', '<>', $currentMonth);
                });
         });
      });
      $count = $data->count();
      $old = $data->paginate(10);
      $data = $data->get();
      return view('subscription.old', compact('old','count'));
    }
    
    public function DeleteOldSubscription(){
      $currentYear = date('Y');
      $currentMonth = date('m');
      Subscription::where(function ($query) use ($currentYear, $currentMonth) {
        $query->whereYear('created_at', '<>', $currentYear)
        ->orWhere(function ($query) use ($currentYear, $currentMonth) {
            $query->whereYear('created_at', '<>', $currentYear)
                ->orWhere(function ($query) use ($currentMonth) {
                    $query->whereMonth('created_at', '<>', $currentMonth);
                });
        });
      })
        ->delete();
        return redirect()->route('paid');
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
      $subscribe = new Subscription([
          'player_id' => $request->player_id,
          'sport_id' => $request->sport_id,
          'subscribe' => $request->subscribe
      ]);
      $subscribe->save();
      return redirect()->route('unpaid')->with('add_success', 'true');
    }

    public function show(string $id)
    {
        $subscription = Subscription::find($id);
        if (!$subscription) {
            return response()->json([
              "ok"=>false,
              "message"=>"ID : $id Not Found",
              "data"=>""
            ],404);
        }
        return response()->json([
            "ok"=>true,
            "message"=>"Data Is Found",
            "data"=>$subscription
          ]);
    }

    public function edit(string $id)
    {
        $subscription = Subscription::find($id);
        return view('subscription.edit', compact('subscription'));
    }

    public function update(Request $request, string $id)
    {
        /*
        $this->validate($request, [
            'subscription_name' => 'required|min:3|max:20',
            'sport_id' => 'required',
        ]);
        $subscription = Subscription::findOrFail($id);
        $subscription->subscription_name = $request->input('subscription_name');
        $subscription->player_id = $request->input('player_id');
        $subscription->sport_id = $request->input('sport_id');
        $subscription->save();
        return redirect()->route('subscription.index')->with('edit_success', 'true');
        */
    }

    public function destroy(string $id)
    {
        Subscription::destroy($id);
        return redirect()->route('paid');
    }
    
    public function PaidSubscription(Request $request)
    {
      $currentYear = date('Y');
      $currentMonth = date('m');
      
      if ($request->has('search')) {
          $paidQuery = Subscription::whereHas('player', function ($query) use ($request) {
              $query->where('player_name', 'like', '%' . $request->input('search') . '%');
          })->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth);
          $paid = $paidQuery->paginate(10);
          $count = $paid->total();
      } else {
          $paidQuery = Subscription::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth);
          $paid = $paidQuery->paginate(10);
          $count = $paid->total();
      }
      $totalPaidSubscribe = $paid->sum('subscribe'); 
      return view('subscription.paid', compact('paid','count','totalPaidSubscribe'));
    }
    
    public function UnPaidSubscription(Request $request)
    {
      $currentYear = date('Y');
      $currentMonth = date('m');
      
      $subscriptionsThisMonth = Subscription::whereYear('created_at', $currentYear)
          ->whereMonth('created_at', $currentMonth)
          ->pluck('player_id'); 
      if ($request->has('search')) {
          $unpaidQuery = Player::where('player_name', 'like', '%' . $request->input('search') . '%')
              ->whereNotIn('id', $subscriptionsThisMonth);
      } else {
          $unpaidQuery = Player::whereNotIn('id', $subscriptionsThisMonth);
      }
      $unpaid = $unpaidQuery->paginate(10);
      $count = $unpaid->total();
      
      /*
      $data = Player::whereNotIn('id', $subscriptionsThisMonth)->get();
      $count = count($data);
      $unpaid = Player::whereNotIn('id', $subscriptionsThisMonth)->paginate(10);
      */
      return view('subscription.unpaid', compact('unpaid','count'));
    }

}
