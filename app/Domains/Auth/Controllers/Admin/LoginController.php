<?php

namespace App\Domains\Auth\Controllers\Admin;

use Illuminate\Http\Request;
use App\Domains\Auth\Actions\LoginAction;
use App\Domains\Auth\Actions\LogoutAction;
use App\Http\Controllers\Controller;
use App\Domains\Auth\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Domains\Auth\DTOs\LoginData;

class LoginController extends Controller
{

    public function __construct(
        public readonly LoginAction $loginAction,
        public readonly LogoutAction $logoutAction,
    ) {

        // $this->middleware('check.subscription');
    }

    public function showLoginForm()
    {
        if (Auth::guard('web')->check()) {
            return Route::has('admin.dashboard')
                ? redirect()->route('admin.dashboard')
                : redirect('/admin/login');
        }

        return view('auth::admin.login');
    }

    public function login(AdminLoginRequest $request)
    {
        $data = LoginData::fromArray(
            $request->validated()
        );

        if (! $this->loginAction->execute($data)) {
            return back()->withErrors([
                'email' => 'بيانات الدخول غير صحيحة.'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $this->logoutAction->execute();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}

// public function register(Request $request)
// {
//     $request->validate([
//         'name'     => 'required|string|max:255',
//         'email'    => 'required|string|email|unique:admins,email',
//         'password' => 'required|string|min:6|confirmed',
//     ]);

//     $user = Admin::create([
//         'name'     => $request->name,
//         'email'    => $request->email,
//         'password' => Hash::make($request->password),
//     ]);

//     Auth::guard('user')->login($user);
    
//     return redirect()->route('/user/dashboard');
// }
