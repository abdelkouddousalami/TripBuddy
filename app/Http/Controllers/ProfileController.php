<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trip;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $trips = Trip::where('user_id', $user->id)->latest()->get();
        $localHotels = Hotel::where('city', $user->city)->latest()->take(3)->get();
        
        return view('profile.show', compact('user', 'trips', 'localHotels'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'city' => ['required', 'string', 'max:255'],
        ]);

        User::where('id', $user->id)->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully!');
    }
}