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
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $query = Trip::with('user')->latest();

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('date')) {
            $date = $request->date;
            $query->where(function($q) use ($date) {
                $q->where('start_date', '<=', $date)
                  ->where('end_date', '>=', $date);
            });
        }

        $trips = $query->paginate(12);
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
            'photo1' => 'nullable|image|mimes:png|max:2048',
            'photo2' => 'nullable|image|mimes:png|max:2048',
            'photo3' => 'nullable|image|mimes:png|max:2048',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $photos = [];
        foreach (['photo1', 'photo2', 'photo3'] as $photo) {
            if ($request->hasFile($photo)) {
                try {
                    $file = $request->file($photo);
                    
                    // Get image info
                    $image = imagecreatefrompng($file->getRealPath());
                    if (!$image) {
                        continue;
                    }

                    // Create a new true color image
                    $width = imagesx($image);
                    $height = imagesy($image);
                    
                    // Calculate new dimensions maintaining aspect ratio
                    $ratio = min(800/$width, 600/$height);
                    $new_width = round($width * $ratio);
                    $new_height = round($height * $ratio);
                    
                    // Create new image
                    $new_image = imagecreatetruecolor($new_width, $new_height);
                    
                    // Preserve transparency
                    imagealphablending($new_image, false);
                    imagesavealpha($new_image, true);
                    
                    // Resize
                    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    
                    // Generate unique filename
                    $filename = uniqid('trip_') . '.png';
                    $path = 'trips/' . $filename;
                    
                    // Save the image
                    ob_start();
                    imagepng($new_image);
                    $imageData = ob_get_clean();
                    
                    // Store the processed image
                    Storage::disk('public')->put($path, $imageData);
                    
                    // Clean up
                    imagedestroy($image);
                    imagedestroy($new_image);
                    
                    $photos[$photo] = $path;
                } catch (\Exception $e) {
                    Log::error('Image processing failed: ' . $e->getMessage());
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
            'photo1' => 'nullable|image|mimes:png|max:2048',
            'photo2' => 'nullable|image|mimes:png|max:2048',
            'photo3' => 'nullable|image|mimes:png|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $photos = [];
        foreach (['photo1', 'photo2', 'photo3'] as $photo) {
            if ($request->hasFile($photo)) {
                // Delete old photo if exists
                if ($trip->$photo) {
                    Storage::disk('public')->delete($trip->$photo);
                }

                try {
                    $file = $request->file($photo);
                    
                    // Get image info
                    $image = imagecreatefrompng($file->getRealPath());
                    if (!$image) {
                        continue;
                    }

                    // Create a new true color image
                    $width = imagesx($image);
                    $height = imagesy($image);
                    
                    // Calculate new dimensions maintaining aspect ratio
                    $ratio = min(800/$width, 600/$height);
                    $new_width = round($width * $ratio);
                    $new_height = round($height * $ratio);
                    
                    // Create new image
                    $new_image = imagecreatetruecolor($new_width, $new_height);
                    
                    // Preserve transparency
                    imagealphablending($new_image, false);
                    imagesavealpha($new_image, true);
                    
                    // Resize
                    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    
                    // Generate unique filename
                    $filename = uniqid('trip_') . '.png';
                    $path = 'trips/' . $filename;
                    
                    // Save the image
                    ob_start();
                    imagepng($new_image);
                    $imageData = ob_get_clean();
                    
                    // Store the processed image
                    Storage::disk('public')->put($path, $imageData);
                    
                    // Clean up
                    imagedestroy($image);
                    imagedestroy($new_image);
                    
                    $photos[$photo] = $path;
                } catch (\Exception $e) {
                    Log::error('Image processing failed: ' . $e->getMessage());
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