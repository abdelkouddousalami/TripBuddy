<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TripController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Trip::with('user')->latest();

        // Search by city
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // Search by date range
        if ($request->filled('start_date')) {
            $query->where('start_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('end_date', '<=', $request->end_date);
        }

        // Filter by budget range
        if ($request->filled('min_budget')) {
            $query->where('budget', '>=', $request->min_budget);
        }
        if ($request->filled('max_budget')) {
            $query->where('budget', '<=', $request->max_budget);
        }

        // Filter by duration
        if ($request->filled('duration')) {
            [$min, $max] = explode('-', $request->duration . '-999');
            $query->whereRaw('DATEDIFF(end_date, start_date) + 1 >= ?', [$min])
                  ->when($max != '999', function($q) use ($max) {
                      $q->whereRaw('DATEDIFF(end_date, start_date) + 1 <= ?', [$max]);
                  });
        }

        // Only show active trips (end date is in the future)
        $query->where('end_date', '>=', now()->toDateString());

        // Filter by buddies needed
        if ($request->filled('min_buddies')) {
            $query->where('buddies_needed', '>=', $request->min_buddies);
        }
        if ($request->filled('max_buddies')) {
            $query->where('buddies_needed', '<=', $request->max_buddies);
        }

        $trips = $query->paginate(12)->withQueryString();
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
            'budget' => 'required|numeric|min:0',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $photos = [];
        foreach (['photo1', 'photo2', 'photo3'] as $photo) {
            if ($request->hasFile($photo)) {
                try {
                    $file = $request->file($photo);
                    $filename = uniqid('trip_') . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('trips', $filename, 'public');
                    $photos[$photo] = $path;
                } catch (\Exception $e) {
                    Log::error('Image upload failed: ' . $e->getMessage());
                    continue;
                }
            }
        }

        $trip = Trip::create([
            ...$validated,
            ...$photos,
            'user_id' => Auth::id()
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
            'budget' => 'required|numeric|min:0',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $photos = [];
        foreach (['photo1', 'photo2', 'photo3'] as $photo) {
            if ($request->hasFile($photo)) {
                try {
                    // Delete old photo if exists
                    if ($trip->$photo) {
                        Storage::disk('public')->delete($trip->$photo);
                    }
                    
                    $file = $request->file($photo);
                    $filename = uniqid('trip_') . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('trips', $filename, 'public');
                    $photos[$photo] = $path;
                } catch (\Exception $e) {
                    Log::error('Image upload failed: ' . $e->getMessage());
                    continue;
                }
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