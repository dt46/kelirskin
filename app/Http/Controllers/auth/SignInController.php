<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    /**
     * Display the login form.
     */
    public function index(string $subdomain = null)
    {
        if (isset($subdomain)) {
            return view("auth.login-main");
        } else {
            return view("auth.login");
        }
    }

    /**
     * Handle user login.
     */
    public function login(LoginRequest $request, string $subdomain = null)
    {
        $request->validated();

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // Check if user exists
        if ($user) {
            // Check user's role
            if ($user->role && $user->role->name != ($subdomain ?? "reseller")) {
                return back()->with('loginFailed', 'Akun yang anda gunakan bukan akun ' . ($subdomain ?? "reseller"));
            }

            // Check if user is a reseller and active
            // if ($user->role && $user->role->name == 'reseller' && !$user->reseller->status) {
            //     return back()->with('loginFailed', 'Saat ini akun anda sedang dinonaktifkan');
            // }
        }

        // Attempt to login
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Redirect based on user role
            if (Auth::user()->role && Auth::user()->role->name == 'reseller') {
                return redirect()->route('general-widget');
            } 
            if (Auth::user()->role && Auth::user()->role->name == 'admin'){
                return redirect()->route('index');
            }
        } else {
            return back()->with('loginFailed', 'Username atau Password salah');
        }
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
