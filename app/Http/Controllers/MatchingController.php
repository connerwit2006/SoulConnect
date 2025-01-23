<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MatchingController extends Controller
{
    /**
     * Get coordinates for a given postcode using Nominatim API.
     */
    private function getCoordinates($postcode){
        $url = "https://nominatim.openstreetmap.org/search?postalcode=" . urlencode($postcode) . "&country=Netherlands&format=json";

        $options = [
            'http' => [
                'header' => "User-Agent: soulconnect (cra.wit.2006@gmail.com)\r\n"
            ]
        ];

        $context = stream_context_create($options);
        $response = @file_get_contents($url, false, $context);

        if ($response === false) {
            return null; // Handle failure gracefully
        }

        $data = json_decode($response, true);

        if (count($data) > 0) {
            return [$data[0]['lat'], $data[0]['lon']];
        }

        return null;
}


    /**
     * Calculate the distance between two coordinates using the Haversine formula.
     */
    private function calculateDistance($coords1, $coords2)
    {
        $earthRadius = 6371; // radius in km

        $lat1 = deg2rad($coords1[0]);
        $lon1 = deg2rad($coords1[1]);
        $lat2 = deg2rad($coords2[0]);
        $lon2 = deg2rad($coords2[1]);

        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos($lat1) * cos($lat2) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // distance in km
    }

    /**
     * Calculate the match score between two users.
     */
    private function calculateMatchScore(User $user, User $otherUser)
    {
        $score = 0;

        // Gender Match
        if ($user->lookingforgender === $otherUser->gender) {
            $score += 50; // Add 50 points for matching preferred gender
        }

        // Relationship Type Match
        if ($user->relationshiptype === $otherUser->relationshiptype) {
            $score += 30; // Add 30 points for matching relationship type
        }

        // Location Match using distance
        $userCoords = $this->getCoordinates($user->postcode);
        $otherUserCoords = $this->getCoordinates($otherUser->postcode);

        if ($userCoords && $otherUserCoords) {
            $distance = $this->calculateDistance($userCoords, $otherUserCoords);

            // Add points based on proximity (closer distances = higher points)
            if ($distance <= 10) {
                $score += 20; // Very close
            } elseif ($distance <= 50) {
                $score += 10; // Close
            }
        }

        return $score;
    }

    /*
     * Find and return matches for the logged in user.
    */
    public function findMatches(Request $request){
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        // Filter potential matches
        $otherUsers = User::where('id', '!=', $userId)
            ->where('gender', $user->lookingforgender)
            ->where('relationshiptype', $user->relationshiptype)
            ->get();

        // Calculate match scores and format output
        $matches = $otherUsers->map(function ($otherUser) use ($user) {
            $matchScore = $this->calculateMatchScore($user, $otherUser);

            return [
                'facecard' => $otherUser->facecard, // Image or null
                'nickname' => $otherUser->nickname,
                'oneliner' => $otherUser->oneliner,
                'score' => $matchScore,
            ];
        });

        // Sort matches by score in descending order
        $sortedMatches = $matches->sortByDesc('score')->values();

        // Pass only relevant data to the view
        return view('pages.matches', ['matches' => $sortedMatches]);
    }
}
