<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:owner')->except(['index', 'show']);
    }

    public function ownerDashboard()
    {
        $hotels = Hotel::where('user_id', auth()->id())->latest()->get();
        return view('hotels.owner-dashboard', compact('hotels'));
    }

    public function index()
    {
        $hotels = Hotel::latest()->paginate(12);
        return view('hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('hotels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|in:hotel,hostel',
            'description' => 'required',
            'city' => 'required|max:255',
            'address' => 'required',
            'photo1' => 'required|image|max:2048',
            'photo2' => 'nullable|image|max:2048',
            'photo3' => 'nullable|image|max:2048',
        ]);

        $hotel = new Hotel($validated);
        $hotel->user_id = auth()->id();

        if ($request->hasFile('photo1')) {
            $hotel->photo1 = $request->file('photo1')->store('hotels', 'public');
        }
        if ($request->hasFile('photo2')) {
            $hotel->photo2 = $request->file('photo2')->store('hotels', 'public');
        }
        if ($request->hasFile('photo3')) {
            $hotel->photo3 = $request->file('photo3')->store('hotels', 'public');
        }

        $hotel->save();

        return redirect()->route('hotels.owner-dashboard')
            ->with('success', 'Property created successfully.');
    }

    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }

    public function edit(Hotel $hotel)
    {
        $this->authorize('update', $hotel);
        return view('hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $this->authorize('update', $hotel);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|in:hotel,hostel',
            'description' => 'required',
            'city' => 'required|max:255',
            'address' => 'required',
            'photo1' => 'nullable|image|max:2048',
            'photo2' => 'nullable|image|max:2048',
            'photo3' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo1')) {
            if ($hotel->photo1) {
                Storage::disk('public')->delete($hotel->photo1);
            }
            $validated['photo1'] = $request->file('photo1')->store('hotels', 'public');
        }

        if ($request->hasFile('photo2')) {
            if ($hotel->photo2) {
                Storage::disk('public')->delete($hotel->photo2);
            }
            $validated['photo2'] = $request->file('photo2')->store('hotels', 'public');
        }

        if ($request->hasFile('photo3')) {
            if ($hotel->photo3) {
                Storage::disk('public')->delete($hotel->photo3);
            }
            $validated['photo3'] = $request->file('photo3')->store('hotels', 'public');
        }

        $hotel->update($validated);

        return redirect()->route('hotels.owner-dashboard')
            ->with('success', 'Property updated successfully.');
    }

    public function destroy(Hotel $hotel)
    {
        $this->authorize('delete', $hotel);

        if ($hotel->photo1) {
            Storage::disk('public')->delete($hotel->photo1);
        }
        if ($hotel->photo2) {
            Storage::disk('public')->delete($hotel->photo2);
        }
        if ($hotel->photo3) {
            Storage::disk('public')->delete($hotel->photo3);
        }

        $hotel->delete();

        return redirect()->route('hotels.owner-dashboard')
            ->with('success', 'Property deleted successfully.');
    }
}
