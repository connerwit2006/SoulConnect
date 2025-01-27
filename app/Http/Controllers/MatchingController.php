<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\User;

class MatchingController extends Controller
{
    /**
     * Calculate the distance between two postcodes using the new template.
     */
    private function calculateDistance($postcode1, $postcode2)
    {
        // Remove the spaces from postcodes and convert them to integers
        $code1 = intval(str_replace(' ', '', $postcode1));
        $code2 = intval(str_replace(' ', '', $postcode2));

        // Calculate the absolute difference between the two integer postcodes
        $distance = abs($code1 - $code2);

        return $distance;
    }

    /**
     * Calculate the match score between two users.
     */
    private function calculateMatchScore(User $user, User $otherUser)
    {
        $score = 0;

        // Gender Match
        if ($user->looking_for_gender === $otherUser->gender) {
            $score += 80; // Add 50 points for matching preferred gender
        }

        // Relationship Type Match
        if ($user->relationship_type === $otherUser->relationship_type) {
            $score += 50; // Add 30 points for matching relationship type
        }

        // Location Match using distance
        $distance = $this->calculateDistance($user->postcode, $otherUser->postcode);

        // Add points based on proximity (closer distances = higher points)
        if ($distance < 1000) {
            $score += 50;
        } elseif ($distance < 2000) {
            $score += 40;
        } elseif ($distance < 3000) {
            $score += 30;
        } elseif ($distance < 4000) {
            $score += 20;
        } elseif ($distance < 5000) {
            $score += 10;
        }
        return $score;
    }

    /*
     * Find and return matches for the logged in user.
    */
    public function findMatches(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        // Filter potential matches
        $otherUsers = User::where('id', '!=', $userId)->get();

        // Get the list of user IDs that the current user has already liked
        $likedUserIds = Like::where('user_id', $userId)->pluck('liked_user_id')->toArray();

        // Calculate match scores and format output
        $matches = $otherUsers->map(function ($otherUser) use ($user, $likedUserIds) {
            $matchScore = $this->calculateMatchScore($user, $otherUser);

            return [
                'id' => $otherUser->id,
                'facecard' => $otherUser->face_card, // Image or null
                'nickname' => $otherUser->nickname,
                'oneliner' => $otherUser->one_liner,
                'score' => $matchScore,
                'liked' => in_array($otherUser->id, $likedUserIds), // Check if the current user has liked this user
            ];
        });

        // Sort matches by score in descending order (higher scores first), exclude the first 5 matches
        $sortedMatches = $matches->sortByDesc('score')->slice(5);
        $paginatedMatches = $sortedMatches->forPage(request('page', 1), 10);

        return view('pages.matches', [
            'matches' => $paginatedMatches,
            'totalPages' => ceil($matches->count() / 10), // To display page links
        ]);
    }


    public function findTopMatches(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        // Filter potential matches
        $otherUsers = User::where('id', '!=', $userId)->get();

        // Get the list of user IDs that the current user has already liked
        $likedUserIds = Like::where('user_id', $userId)->pluck('liked_user_id')->toArray();

        // Calculate match scores and format output
        $matches = $otherUsers->map(function ($otherUser) use ($user, $likedUserIds) {
            $matchScore = $this->calculateMatchScore($user, $otherUser);

            return [
                'id' => $otherUser->id,
                'facecard' => $otherUser->face_card, // Image or null
                'nickname' => $otherUser->nickname,
                'oneliner' => $otherUser->one_liner,
                'score' => $matchScore,
                'liked' => in_array($otherUser->id, $likedUserIds), // Check if the current user has liked this user
            ];
        });

        // Sort matches by score in descending order
        $sortedMatches = $matches->sortByDesc('score')->values();

        // Pass only the top 5 matches to the view
        return view('pages.topmatches', ['matches' => $sortedMatches->take(5)]);
    }
}
