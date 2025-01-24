<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display 10 profiles for the logged-in user.
     */
    public function index(Request $request)
    {
        $userId = Auth::id(); // Get the currently logged-in user

        // Fetch 10 profiles the user has not interacted with
        $profiles = User::where('id', '!=', $userId)
            ->whereNotIn('id', function ($query) use ($userId) {
                $query->select('liked_user_id')
                    ->from('likes')
                    ->where('user_id', $userId);
            })
            ->take(10)
            ->get();

        return view('pages.profiles', compact('profiles'));
    }

    /**
     * Handle like or skip action.
     */
    public function interact(Request $request)
    {
        try {
            $request->validate([
                'liked_user_id' => 'required|exists:users,id',
                'action' => 'required|in:like,skip',
            ]);

            $userId = Auth::id();
            $likedUserId = $request->input('liked_user_id');
            $action = $request->input('action');

            // Save the like or skip action
            DB::table('likes')->insert([
                'user_id' => $userId,
                'liked_user_id' => $likedUserId,
                'status' => $action,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function likedBy()
    {
        $userId = auth()->id();

        // Fetch users who liked the authenticated user but exclude those whom the user has already liked
        $likedBy = User::whereHas('likesGiven', function ($query) use ($userId) {
            $query->where('liked_user_id', $userId);
        })
            ->whereDoesntHave('likesReceived', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();

        return view('pages.liked_by', ['likedBy' => $likedBy]);
    }




    public function fetchProfiles()
    {
        $user = auth()->user();
        $excludedProfileIds = Like::where('user_id', $user->id)->pluck('liked_user_id');

        $profiles = User::where('id', '!=', $user->id)
            ->whereNotIn('id', $excludedProfileIds)
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'profiles' => $profiles,
        ]);
    }

    public function likeBack(Request $request)
    {
        $request->validate([
            'liked_user_id' => 'required|exists:users,id',
        ]);

        $userId = auth()->id();
        $likedUserId = $request->liked_user_id;

        // Check if the like already exists (to avoid duplicates)
        $existingLike = Like::where('user_id', $userId)
            ->where('liked_user_id', $likedUserId)
            ->first();

        if (!$existingLike) {
            // Create a reciprocal like
            Like::create([
                'user_id' => $userId,
                'liked_user_id' => $likedUserId,
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function ignore(Request $request)
    {
        $request->validate([
            'liked_user_id' => 'required|exists:users,id',
        ]);

        $userId = auth()->id();
        $likedUserId = $request->liked_user_id;

        // Remove the like where the other user liked the current user
        $like = Like::where('user_id', $likedUserId)
            ->where('liked_user_id', $userId)
            ->first();

        if ($like) {
            $like->delete();
        }

        return response()->json(['success' => true]);
    }
}
