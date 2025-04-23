<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\OwnerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class OwnerRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reason' => 'required|string|min:10',
            'hotel_name' => 'required|string|max:255',
            'hotel_type' => 'required|in:hotel,hostel',
            'description' => 'required|string|min:10',
            'address' => 'required|string',
            'city' => 'required|string',
            'photo1' => 'required|image|max:2048',
            'photo2' => 'nullable|image|max:2048',
            'photo3' => 'nullable|image|max:2048',
            'proof_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        // Handle file uploads
        $photo1Path = $request->file('photo1')->store('hotels', 'public');
        $photo2Path = $request->hasFile('photo2') ? $request->file('photo2')->store('hotels', 'public') : null;
        $photo3Path = $request->hasFile('photo3') ? $request->file('photo3')->store('hotels', 'public') : null;
        $proofPath = $request->file('proof_document')->store('proofs', 'public');

        $hotel = new Hotel();
        $hotel->user_id = Auth::id(); 
        $hotel->name = $validated['hotel_name'];
        $hotel->type = $validated['hotel_type'];
        $hotel->description = $validated['description'];
        $hotel->address = $validated['address'];
        $hotel->city = $validated['city'];
        $hotel->photo1 = $photo1Path;
        $hotel->photo2 = $photo2Path;
        $hotel->photo3 = $photo3Path;
        $hotel->proof_document = $proofPath;
        $hotel->save();

        // Create owner request
        $ownerRequest = new OwnerRequest();
        $ownerRequest->user_id = Auth::id();
        $ownerRequest->reason = $validated['reason'];
        $ownerRequest->status = 'pending';
        $ownerRequest->hotel_id = $hotel->id;
        $ownerRequest->save();

        return back()->with('success', 'Your owner request has been submitted successfully.');
    }

    public function approve(OwnerRequest $ownerRequest)
    {
        $ownerRequest->status = 'approved';
        $ownerRequest->save();

        $ownerRequest->user->role = 'owner';
        $ownerRequest->user->save();

        return back()->with('success', 'Owner request approved successfully.');
    }

    public function reject(OwnerRequest $ownerRequest)
    {
        $ownerRequest->status = 'rejected';
        $ownerRequest->save();

        $hotel = $ownerRequest->hotel;
        if ($hotel) {
            Storage::disk('public')->delete($hotel->photo1);
            if ($hotel->photo2) Storage::disk('public')->delete($hotel->photo2);
            if ($hotel->photo3) Storage::disk('public')->delete($hotel->photo3);
            Storage::disk('public')->delete($hotel->proof_document);
            $hotel->delete();
        }

        return back()->with('success', 'Owner request rejected successfully.');
    }

    public function show(OwnerRequest $ownerRequest)
    {
        $this->authorize('view', $ownerRequest);
        return view('admin.owner-requests.show', compact('ownerRequest'));
    }
}
