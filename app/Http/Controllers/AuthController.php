<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\UpdateRatingRequest;
use App\Http\Requests\UpdatePasswordRequest;

class AuthController extends Controller
{
    public function getLogin() {
        return view('auth.login');
    }

    public function getRegister() {
        return view('auth.register');
    }

    public function login(LoginRequest $request) {
        if (Auth::attempt($request->only('email', 'password'))) {
            
            Auth::login(Auth::user(), $request->remember_me);
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(RegisterRequest $request) {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.page');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->back();
    }

    public function updatePassword(UpdatePasswordRequest $request) {
        $user = $request->user();
        if (Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->newPassword);
            $user->save();
            return redirect()->back()->with('success', 'Password updated successfully');
        }
        return redirect()->back()->withErrors([
            'password' => 'The password you entered is incorrect.',
        ]);
    }
}
