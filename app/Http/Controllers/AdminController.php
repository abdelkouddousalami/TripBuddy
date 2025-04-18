<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trip;
use App\Models\Comment;
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
        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'total_trips' => Trip::count(),
            'total_comments' => Comment::count(),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_trips' => Trip::with('user')->latest()->take(5)->get(),
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
}
