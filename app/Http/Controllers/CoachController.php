<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Coach;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $sports = Sport::all(); 
        if ($request->has('search')) {
            $coachesQuery = Coach::where('coach_name', 'like', '%' . $request->input('search') . '%')->orderBy('sport_id');
            $coaches = $coachesQuery->paginate(10); 
            $count = $coaches->total();
        } else {
            $coaches = Coach::orderBy('sport_id')->paginate(10); 
            $count = Coach::count();
        }
        return view('coaches.index', compact('coaches','sports','count'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'coach_name' => 'required|min:4|max:20',
          'sport_id' => 'required',
      ]);
      $coach = new Coach([
          'coach_name' => $request->coach_name,
          'sport_id' => $request->sport_id
      ]);
      $coach->save();
      return redirect()->route('coaches.index')->with('add_success', 'true');
    }

    public function show(string $id)
    {
        $coach = Coach::find($id);
        if (!$coach) {
            return response()->json([
              "ok"=>false,
              "message"=>"ID : $id Not Found",
              "data"=>""
            ],404);
        }
        return response()->json([
            "ok"=>true,
            "message"=>"Data Is Found",
            "data"=>$coach
          ]);
    }

    public function edit(string $id)
    {
        $sports = Sport::all();
        $coach = Coach::find($id);
        return view('coaches.edit', compact('coach','sports'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'coach_name' => 'required|min:3|max:20',
            'sport_id' => 'required',
        ]);
        $coach = Coach::findOrFail($id);
        $coach->coach_name = $request->input('coach_name');
        $coach->sport_id = $request->input('sport_id');
        $coach->save();
        return redirect()->route('coaches.index')->with('edit_success', 'true');
    }

    public function destroy(string $id)
    {
        Coach::destroy($id);
        return redirect()->route('coaches.index');
    }
}
