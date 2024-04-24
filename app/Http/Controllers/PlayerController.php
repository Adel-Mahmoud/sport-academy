<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\File;


class PlayerController extends Controller
{
    use FileUploadTrait;
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $sports = Sport::all(); 
        $teams = Team::all(); 
        $this->deleteUnusedImages();
        if ($request->has('search')) {
            $playersQuery = Player::where('player_name', 'like', '%' . $request->input('search') . '%')->orderBy('sport_id');
            $players = $playersQuery->paginate(10); 
            $count = $players->total();
        } else {
            $players = Player::orderBy('sport_id')->paginate(10); 
            $count = Player::count();
        }
        return view('players.index', compact('players','sports','teams','count'));
    }

    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
      $this->validate($request, [
        'player_name' => 'required|min:4|max:20',
        'date_of_pirth' => 'required|date',
        'phone' => 'required|min:5|max:15',
        'email' => 'required|min:5|max:20',
        'sport_id' => 'required',
        'profile_picture' => 'required',
        'id_card_picture' => 'required',
        'club_membership_picture' => 'required',
      ]);
      if ($request->hasFile('profile_picture')) {
          $uploadedFile = $request->file('profile_picture');
          $image1 = $this->uploadFile($uploadedFile,'players');
      }
      if ($request->hasFile('id_card_picture')) {
          $uploadedFile = $request->file('id_card_picture');
          $image2 = $this->uploadFile($uploadedFile,'players');
      }
      if ($request->hasFile('club_membership_picture')) {
          $uploadedFile = $request->file('club_membership_picture');
          $image3 = $this->uploadFile($uploadedFile,'players');
      }
      $player = new Player([
          'player_name' => $request->player_name,
          'date_of_pirth' => $request->date_of_pirth,
          'phone' => $request->phone,
          'email' => $request->email,
          'profile_picture' => $image1,
          'id_card_picture' => $image2,
          'club_membership_picture' => $image3,
          'sport_id' => $request->sport_id,
          'team_id' => $request->team_id
      ]);
      $player->save();
      return redirect()->route('players.index')->with('add_success', 'true');
    }

    public function show(string $id)
    {
        $player = Player::find($id);
        if (!$player) {
            return response()->json([
              "ok"=>false,
              "message"=>"ID : $id Not Found",
              "data"=>""
            ],404);
        }
        return response()->json([
            "ok"=>true,
            "message"=>"Data Is Found",
            "data"=>$player
          ]);
    }

    public function edit(string $id)
    {
        $sports = Sport::all();
        $teams = Team::all(); 
        $player = Player::find($id);
        return view('players.edit', compact('player','sports','teams'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
          'player_name' => 'required|min:4|max:20',
          'date_of_pirth' => 'required|date',
          'phone' => 'required|min:5|max:15',
          'email' => 'required|min:5|max:20',
          'sport_id' => 'required',
        ]);
        $player = Player::findOrFail($id);
        if ($request->hasFile('profile_picture')) {
            $uploadedFile = $request->file('profile_picture');
            $previousImage1 = $this->uploadFile($uploadedFile,'players');
        } else {
          $previousImage1 = $request->input('profile_picture_static');
        }
        if ($request->hasFile('id_card_picture')) {
            $uploadedFile = $request->file('id_card_picture');
            $previousImage2 = $this->uploadFile($uploadedFile,'players');
        } else {
          $previousImage2 = $request->input('id_card_picture_static');
        }
        if ($request->hasFile('club_membership_picture')) {
            $uploadedFile = $request->file('club_membership_picture');
            $previousImage3 = $this->uploadFile($uploadedFile,'players');
        } else {
          $previousImage3 = $request->input('club_membership_picture_static');
        }
        $player->player_name = $request->input('player_name');
        $player->date_of_pirth = $request->input('date_of_pirth');
        $player->phone = $request->input('phone');
        $player->email = $request->input('email');
        $player->profile_picture = $previousImage1;
        $player->id_card_picture = $previousImage2;
        $player->club_membership_picture = $previousImage3;
        $player->sport_id = $request->input('sport_id');
        $player->team_id = $request->input('team_id');
        $player->save();
        return redirect()->route('players.index')->with('edit_success', 'true');
    }

    public function destroy(string $id)
    {
        Player::destroy($id);
        $this->deleteUnusedImages();
        return redirect()->back();
    }
    
    private function deleteUnusedImages()
    {
        $imagePath = public_path('images/players');
        $imageFiles = File::files($imagePath);
        $usedImages = Player::pluck('profile_picture')
            ->concat(Player::pluck('id_card_picture'))
            ->concat(Player::pluck('club_membership_picture'))
            ->filter()
            ->toArray();
        if (count($imageFiles) > 0) {
            foreach ($imageFiles as $imageFile) {
                $pathInfo = pathinfo($imageFile);
                $fileNameWithExtension = $pathInfo['filename'] . '.' . $pathInfo['extension'];
                if (!in_array($fileNameWithExtension, $usedImages)) {
                    File::delete($imageFile);
                }
            }
        }
    }
}
