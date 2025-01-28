<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\User;

class MatchingController extends Controller
{
    //simple difference calculator for the postcodes between 2 users
    private function calculateDistance($postcode1, $postcode2)
    {
        // convert postcodes to integers
        $code1 = intval(str_replace(' ', '', $postcode1));
        $code2 = intval(str_replace(' ', '', $postcode2));

        // Calculate the absolute difference between the two integer postcodes
        $distance = abs($code1 - $code2);

        return $distance;
    }

    //algorithm to calculate match score between 2 users
    public function calculateMatchScore(User $user, User $otherUser)
    {
        $score = 0;

        // Gender Match
        if ($user->looking_for_gender === $otherUser->gender) {
            $score += 80;
        }

        // Relationship Type Match
        if ($user->relationship_type === $otherUser->relationship_type) {
            $score += 50;
        }

        // Location Match using distance
        $distance = $this->calculateDistance($user->postcode, $otherUser->postcode);

        // Add points based on distance (closer distance = higher score)
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

    //sort and display matches
    public function findMatches(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        // filter out the logged in user
        $otherUsers = User::where('id', '!=', $userId)->get();

        // check which users has already been liked by the current user
        $likedUserIds = Like::where('user_id', $userId)->pluck('liked_user_id')->toArray();

        // calculate the score and format the output
        $matches = $otherUsers->map(function ($otherUser) use ($user, $likedUserIds) {
            $matchScore = $this->calculateMatchScore($user, $otherUser);

            return [
                'id' => $otherUser->id,
                'facecard' => $otherUser->face_card,
                'nickname' => $otherUser->nickname,
                'oneliner' => $otherUser->one_liner,
                'score' => $matchScore,
                'liked' => in_array($otherUser->id, $likedUserIds),
            ];
        });

        // sort matches by score in descending order (higher scores first), exclude the first 5 matches
        $sortedMatches = $matches->sortByDesc('score')->slice(5);
        $paginatedMatches = $sortedMatches->forPage(request('page', 1), 10);

        return view('pages.matches', [
            'matches' => $paginatedMatches,
            'totalPages' => ceil($matches->count() / 10), //pagination
        ]);
    }

    //sort and display top 5 matches
    public function findTopMatches(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        // filter out the logged in user
        $otherUsers = User::where('id', '!=', $userId)->get();

        // check which users has  already been liked by the current user
        $likedUserIds = Like::where('user_id', $userId)->pluck('liked_user_id')->toArray();

        // calculate the scores and format the output
        $matches = $otherUsers->map(function ($otherUser) use ($user, $likedUserIds) {
            $matchScore = $this->calculateMatchScore($user, $otherUser);

            return [
                'id' => $otherUser->id,
                'facecard' => $otherUser->face_card,
                'nickname' => $otherUser->nickname,
                'oneliner' => $otherUser->one_liner,
                'score' => $matchScore,
                'liked' => in_array($otherUser->id, $likedUserIds),
            ];
        });

        // Sort matches by score in descending order
        $sortedMatches = $matches->sortByDesc('score')->values();

        // Pass only the top 5 matches to the view
        return view('pages.topmatches', ['matches' => $sortedMatches->take(5)]);
    }

    public function dashboard(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        // Filter out the logged-in user
        $otherUsers = User::where('id', '!=', $userId)->get();

        // Check which users have already been liked by the current user
        $likedUserIds = Like::where('user_id', $userId)->pluck('liked_user_id')->toArray();

        // Calculate matches
        $matches = $otherUsers->map(function ($otherUser) use ($user, $likedUserIds) {
            $matchScore = $this->calculateMatchScore($user, $otherUser);

            return [
                'id' => $otherUser->id,
                'facecard' => $otherUser->face_card ? asset('images/' . $otherUser->face_card) : 'https://via.placeholder.com/150',
                'nickname' => $otherUser->nickname,
                'oneliner' => $otherUser->one_liner,
            ];
        });

        // Sort matches by score in descending order
        $sortedMatches = $matches->sortByDesc('score')->values();

        // Split into top 5 matches and potential matches
        $topMatches = $sortedMatches->take(5);
        $potentialMatches = $sortedMatches->slice(5);

        // Return the data to the dashboard view
        return view('pages.dashboard', [
            'topMatches' => $topMatches,
            'potentialMatches' => $potentialMatches,
        ]);
    }

    public function profileDetail(Request $request, $id)
    {
        $user = User::findOrFail($request->user()->id);
        $selectedProfile = User::findOrFail($id); // Ensure this is correct

        // Prepare profile data for the view
        $person = [
            'id' => $selectedProfile->id,
            'name' => $selectedProfile->nickname ?? 'No Name',
            'age' => $selectedProfile->dob ? \Carbon\Carbon::parse($selectedProfile->dob)->age : 'Unknown Age',
            'location' => $selectedProfile->postcode ?? 'Unknown Location',
            'gender' => $selectedProfile->gender ?? 'Unknown Gender',
            'description' => $selectedProfile->one_liner ?? 'No description available',
            'img' => $selectedProfile->face_card
                ? asset('images/' . $selectedProfile->face_card)
                : 'https://via.placeholder.com/150',
        ];

        $slides = [
            ['image' => asset('image/HappyMen.jpg')],
            ['image' => asset('image/HappyMen2.jpg')],
            ['image' => asset('image/PersonOnPhone.jpg')],
        ];

        // Generate random matches
        $otherUsers = User::where('id', '!=', $user->id)->get();
        $potentialMatches = $otherUsers->map(function ($otherUser) use ($user) {
            return [
                'id' => $otherUser->id,
                'facecard' => $otherUser->face_card
                    ? asset('images/' . $otherUser->face_card)
                    : 'https://via.placeholder.com/150',
                'nickname' => $otherUser->nickname ?? 'No Nickname',
                'oneliner' => $otherUser->one_liner ?? 'No Oneliner',
            ];
        });

        $matches = $potentialMatches->shuffle()->take(5)->map(function ($person) {
            return [
                'id' => $person['id'],
                'img' => $person['facecard'] ?? 'https://via.placeholder.com/150',
                'name' => $person['nickname'] ?? 'No Nickname',
            ];
        });

        return view('pages.profileDetail', compact('person', 'slides', 'matches'));
    }
}
