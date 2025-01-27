<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    //fetch users and display them to pages/profiles.blade.php
    public function index(Request $request)
    {
        $userId = Auth::id(); // fetch logged in user ID

        // fetch 10 profiles that the logged in user hasn't interacted with
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

    //handle like or skip action
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

            // save like or skip action
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

    //fetch users who liked the logged in user
    public function likedBy()
    {
        $userId = auth()->id();

        $likedBy = User::select('users.*')
            ->join('likes', 'likes.user_id', '=', 'users.id')
            ->where('likes.liked_user_id', $userId)
            ->orderByDesc('likes.id')
            ->paginate(10);

        return view('pages.liked_by', ['likedBy' => $likedBy]);
    }

    //fetch profiles to put into the like page (excluding profiles that the logged in user liked)
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

    //like a profile that liked you back
    public function likeBack(Request $request)
    {
        $request->validate([
            'liked_user_id' => 'required|exists:users,id',
        ]);

        $userId = auth()->id();
        $likedUserId = $request->liked_user_id;

        //check for duplicates
        $existingLike = Like::where('user_id', $userId)
            ->where('liked_user_id', $likedUserId)
            ->first();

        if (!$existingLike) {
            Like::create([
                'user_id' => $userId,
                'liked_user_id' => $likedUserId,
            ]);
        }

        return response()->json(['success' => true]);
    }

    //remove the like that a profile gave the logged in user
    public function ignore(Request $request)
    {
        $request->validate([
            'liked_user_id' => 'required|exists:users,id',
        ]);

        $userId = auth()->id();
        $likedUserId = $request->liked_user_id;

        $like = Like::where('user_id', $likedUserId)
            ->where('liked_user_id', $userId)
            ->first();

        if ($like) {
            $like->delete();
        }

        return response()->json(['success' => true]);
    }

    //fetch all profiles that the logged in user liked
    public function likedUsers()
    {
        $userId = auth()->id();

        $likedUsers = User::select('users.*')
            ->join('likes', 'likes.liked_user_id', '=', 'users.id')
            ->where('likes.user_id', $userId)
            ->where('likes.status', 'like')
            ->orderByDesc('likes.id')
            ->paginate(10);

        return view('pages.liked_users', ['likedUsers' => $likedUsers]);
    }

    //delete a like that the logged in user gave to a profile
    public function removeLike(Request $request)
    {
        $userId = auth()->id();
        $likedUserId = $request->input('liked_user_id');

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
