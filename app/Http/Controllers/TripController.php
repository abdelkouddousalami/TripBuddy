<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TripController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $trips = Trip::with('user')->latest()->paginate(12);
        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        return view('trips.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'buddies_needed' => 'required|integer|min:1',
            'photo1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $photos = [];
        foreach (['photo1', 'photo2', 'photo3'] as $photo) {
            if ($request->hasFile($photo)) {
                $path = $request->file($photo)->store('trips', 'public');
                $photos[$photo] = $path;
            }
        }

        $trip = auth()->user()->trips()->create([
            ...$validated,
            ...$photos
        ]);

        return redirect()->route('trips.show', $trip)
            ->with('success', 'Trip announcement created successfully!');
    }

    public function show(Trip $trip)
    {
        return view('trips.show', compact('trip'));
    }

    public function edit(Trip $trip)
    {
        $this->authorize('update', $trip);
        return view('trips.edit', compact('trip'));
    }

    public function update(Request $request, Trip $trip)
    {
        $this->authorize('update', $trip);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'buddies_needed' => 'required|integer|min:1',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $photos = [];
        foreach (['photo1', 'photo2', 'photo3'] as $photo) {
            if ($request->hasFile($photo)) {
                if ($trip->$photo) {
                    Storage::disk('public')->delete($trip->$photo);
                }
                $path = $request->file($photo)->store('trips', 'public');
                $photos[$photo] = $path;
            }
        }

        $trip->update([
            ...$validated,
            ...$photos
        ]);

        return redirect()->route('trips.show', $trip)
            ->with('success', 'Trip announcement updated successfully!');
    }

    public function destroy(Trip $trip)
    {
        $this->authorize('delete', $trip);
        
        foreach (['photo1', 'photo2', 'photo3'] as $photo) {
            if ($trip->$photo) {
                Storage::disk('public')->delete($trip->$photo);
            }
        }

        $trip->delete();

        return redirect()->route('trips.index')
            ->with('success', 'Trip announcement deleted successfully!');
    }
}