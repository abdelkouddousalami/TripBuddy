<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::id());
            
            if ($user && $user->status === 'suspended' && $user->suspended_until) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account is suspended until ' . $user->suspended_until->format('M d, Y H:i:s') . '.',
                ]);
            }

            $request->session()->regenerate();
            
            if($user && $user->role === 'admin'){
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->route('profile.show');
        }
            
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'city' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'city' => $validated['city'],
            'role' => 'tripper',
            'status' => 'active'
        ]);

        Auth::login($user);
        return redirect()->route('profile.show');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}