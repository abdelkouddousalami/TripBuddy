<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = $trip->comments()->create([
            'content' => $validated['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() === $comment->user_id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully!');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }
}
