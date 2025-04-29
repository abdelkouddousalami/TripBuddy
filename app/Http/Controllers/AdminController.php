<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trip;
use App\Models\Comment;
use App\Models\OwnerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_trips' => Trip::count(),
            'total_comments' => Comment::count(),
            'recent_users' => User::latest()->take(10)->get(),
            'recent_trips' => Trip::with('user')->latest()->take(10)->get(),
            'owner_requests' => OwnerRequest::with(['user', 'hotel'])->latest()->get(),
            'users_by_role' => User::select('role', DB::raw('count(*) as count'))
                                ->groupBy('role')
                                ->get(),
            'trips_by_month' => Trip::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function updateRole(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:tripper,admin,owner'
        ]);

        $user = User::findOrFail($validated['user_id']);
        $user->role = $validated['role'];
        $user->save();

        return back()->with('success', 'User role updated successfully.');
    }

    public function deleteUser(User $user)
    {
        if($user->isAdmin()) {
            return back()->with('error', 'Cannot delete admin users');
        }
        
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function suspendUser(User $user)
    {
        if($user->isAdmin()) {
            return back()->with('error', 'Cannot suspend admin users');
        }
        
        $user->suspend();
        return back()->with('success', 'User suspended successfully for 24 hours.');
    }
}
