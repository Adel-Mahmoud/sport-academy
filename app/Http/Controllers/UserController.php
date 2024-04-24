<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $usersQuery = User::where('name', 'like', '%' . $request->input('search') . '%');
            $users = $usersQuery->paginate(10); 
            $count = $users->total();
        } else {
            $users = User::paginate(10); 
            $count = User::count();
        }
        return view('users.index', compact('users','count'));
    }

    public function create()
    {
        //
    }

    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        if ($request->avatar) {
          if($request->hasFile('avatar')) {
            $allowedfileExtension=['jpeg','jpg','png'];
            $file = $request->file('avatar');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);
            if($check){
                $img = rand(1000000000, 9999999999) . $file->getClientOriginalName();
                $file->move('storage/images/', $img);
                $user->avatar = $img;
            }
          }
        }
        $user->save();
        return redirect()->route('users.index')->with('add_success', 'true');
    }

    public function show(string $id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        $old_password = $user->password;
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->u_email;
        if ($request->filled('u_password')) {
            $user->password = Hash::make($request->u_password);
        }
        $user->role = $request->role;
        if ($request->avatar) {
          if($request->hasFile('avatar')) {
            $allowedfileExtension=['jpeg','jpg','png'];
            $file = $request->file('avatar');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);
            if($check){
                $img = rand(1000000000, 9999999999) . $file->getClientOriginalName();
                $file->move('storage/images/', $img);
                $user->avatar = $img;
            }
          }
        }
        $user->save();
        return redirect()->route('users.index')->with('edit_success', 'true');
    }

    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->route('users.index');
    }
}
