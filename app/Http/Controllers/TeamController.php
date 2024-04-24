<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $sports = Sport::all(); 
        if ($request->has('search')) {
            $teamsQuery = Team::where('team_name', 'like', '%' . $request->input('search') . '%');
            $teams = $teamsQuery->paginate(10); 
            $count = $teams->total();
        } else {
            $teams = Team::paginate(10); 
            $count = Team::count();
        }
        return view('teams.index', compact('teams','sports','count'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'team_name' => 'required|min:3|max:20',
      ]);
      $team = new team([
          'team_name' => $request->team_name,
          'sport_id' => $request->sport_id
      ]);
      $team->save();
      return redirect()->route('teams.index')->with('add_success', 'true');
    }

    public function show(Request $request,string $id)
    {
        $team_name = Team::find($id)->team_name;
        $playersQuery = Player::whereHas('team', function ($query) use ($id) {
            $query->where('id', $id);
        });
        if ($request->has('search')) {
            $playersQuery->where('player_name', 'like', '%' . $request->input('search') . '%');
        }
        $players = $playersQuery->paginate(10);
        $count = $players->total();
        return view('teams.view', compact('players','team_name','count'));
    }

    public function edit(string $id)
    {
        $sports = Sport::all(); 
        $team = Team::find($id);
        return view('teams.edit', compact('team','sports'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'team_name' => 'required|min:3|max:20'
        ]);
        $team = Team::findOrFail($id);
        $team->team_name = $request->input('team_name');
        $team->sport_id = $request->input('sport_id');
        $team->save();
        return redirect()->route('teams.index')->with('edit_success', 'true');
    }

    public function destroy(string $id)
    {
        Team::destroy($id);
        return redirect()->route('teams.index');
    }
}
