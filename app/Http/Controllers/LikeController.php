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
        $userId = auth()->id(); // Get the logged-in user's ID

        // Fetch users who liked the logged-in user, ordered by the most recent like
        $likedBy = User::select('users.*') // Select all columns from the 'users' table
            ->join('likes', 'likes.user_id', '=', 'users.id') // Join the 'likes' table on 'user_id'
            ->where('likes.liked_user_id', $userId) // Filter by the logged-in user being liked
            ->orderByDesc('likes.id') // Order by the most recent like (by 'likes.id')
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

    public function likedUsers()
    {
        $userId = auth()->id(); // Get the logged-in user's ID

        // Fetch users the logged-in user has liked, ordered by the most recent like
        $likedUsers = User::select('users.*') // Select all columns from the 'users' table
            ->join('likes', 'likes.liked_user_id', '=', 'users.id') // Join the 'likes' table on 'liked_user_id'
            ->where('likes.user_id', $userId) // Filter by the logged-in user's likes
            ->orderByDesc('likes.id') // Order by the most recent like (by 'likes.id')
            ->get();

        return view('pages.liked_users', ['likedUsers' => $likedUsers]);
    }

    public function removeLike(Request $request)
    {
        $userId = auth()->id();
        $likedUserId = $request->input('liked_user_id');

        // Find and delete the like
        $like = Like::where('user_id', $userId)
            ->where('liked_user_id', $likedUserId)
            ->first();

        if ($like) {
            $like->delete();

            return response()->json([
                'success' => true,
                'message' => 'Like removed successfully.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Like not found.',
        ], 404);
    }
}
