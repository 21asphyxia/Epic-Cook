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
 
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(RegisterRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function forgotPassword(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

       
        $message = $status === Password::RESET_LINK_SENT ? ['status' => __($status)] : ['email' => __($status)];
        return response()->json([
            $message
        ]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ?response()->json(['message'=>'successful reset'])
            : response()->json(['message'=>'something went wrong']);
    }
}
