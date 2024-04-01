<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role'=> '1'])) {
            $request->session()->regenerate();

            Session::put('middleware', 'admin');
            
            return redirect()->intended('dashboard');
        }
        elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => '3'])) {
            $user = Auth::user();
            $request->session()->regenerate();

            Session::put('middleware', 'user');
            Session::put('login_username', $user->username);
            Session::put('login_id', $user->user_id);

            return redirect()->intended('user');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
