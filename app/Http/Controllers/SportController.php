<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Player;
use Illuminate\Http\Request;

class SportController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $sportsQuery = Sport::where('sport_name', 'like', '%' . $request->input('search') . '%');
            $sports = $sportsQuery->paginate(10); 
            $count = $sports->total();
        } else {
            $sports = Sport::paginate(10); 
            $count = Sport::count();
        }
        return view('sports.index', compact('sports','count'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'sport_name' => 'required|min:3|max:20',
      ]);
      $sport = new Sport([
          'sport_name' => $request->sport_name
      ]);
      $sport->save();
      return redirect()->route('sports.index')->with('add_success', 'true');
    }

    public function show(Request $request, string $id)
    {
        $sport_name = Sport::find($id)->sport_name;
        $playersQuery = Player::whereHas('sport', function ($query) use ($id) {
            $query->where('id', $id);
        });
        if ($request->has('search')) {
            $playersQuery->where('player_name', 'like', '%' . $request->input('search') . '%');
        }
        $players = $playersQuery->paginate(10);
        $count = $players->total();
        return view('sports.view', compact('players', 'sport_name', 'count'));
    }

    public function edit(string $id)
    {
        $sport = Sport::find($id);
        return view('sports.edit', compact('sport'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'sport_name' => 'required|min:3|max:20'
        ]);
        $sport = Sport::findOrFail($id);
        $sport->sport_name = $request->input('sport_name');
        $sport->save();
        return redirect()->route('sports.index')->with('edit_success', 'true');
    }

    public function destroy(string $id)
    {
        Sport::destroy($id);
        return redirect()->route('sports.index');
    }
}
