<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Toon het profiel formulier van de gebruiker.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Werk de profielinformatie van de gebruiker bij.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $user = Auth::user();

        //Validatie regels
        $request->validate([
            'one_liner' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date', 'before:-18 years'],
            'looking_for_gender' => 'required|string',
            'appreciate' => 'required|string',
            'nickname' => 'required|string|max:255',
            'relationship_type' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'postcode' => ['required', 'string', 'max:255'],
            'hobbies' => ['nullable', 'string', 'max:255'],
            'pets' => ['required', 'in:yes,no'],
            'music_styles' => ['nullable', 'string', 'max:255'],
            'kinderen' => ['required', 'in:yes,no'],
            'kinderwens' => ['required', 'in:yes,no'],
        ]);

        // Werk de profielinformatie van de gebruiker bij
        $user->one_liner = $request->input('one_liner');
        $user->dob = $request->input('dob');
        $user->looking_for_gender = $request->input('looking_for_gender');
        $user->nickname = $request->input('nickname');
        $user->relationship_type = $request->input('relationship_type');
        $user->gender = $request->input('gender');
        $user->appreciate = $request->input('appreciate');
        $user->postcode = $request->input('postcode');
        $user->hobbies = $request->input('hobbies');
        $user->pets = $request->input('pets');
        $user->music_styles = $request->input('music_styles');
        $user->kinderen = $request->input('kinderen');
        $user->kinderwens = $request->input('kinderwens');

        $user = $request->user();

        if ($request->hasFile('face_card')) { // Gebruik face_card hier
            $imageName = time() . '.' . $request->face_card->getClientOriginalExtension(); // Corrigeer de methodenaam en veldnaam
            $request->face_card->move(public_path('images'), $imageName);
            $user->face_card = $imageName; // Sla de afbeelding naam op in de face_card kolom
        }
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Verwijder het account van de gebruiker.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show($id): View
    {
        $user = User::findOrFail($id);

        $person = [
            'id' => $user->id,
            'name' => $user->nickname,
            'age' => \Carbon\Carbon::parse($user->dob)->age,
            'location' => $user->postcode,
            'gender' => $user->gender,
            'description' => $user->one_liner,
            'img' => $user->face_card ? asset('images/' . $user->face_card) : 'default_image_url',
        ];

        $slides = [
            ['image' => asset('image/HappyMen.jpg')],
            ['image' => asset('image/HappyMen2.jpg')],
            ['image' => asset('image/PersonOnPhone.jpg')],
        ];

        // Fetch dynamic potential matches
        $matches = User::where('id', '!=', $id)
            ->inRandomOrder()
            ->take(5)
            ->get()
            ->map(function ($match) {
                return [
                    'id' => $match->id,
                    'name' => $match->nickname,
                    'img' => $match->face_card ? asset('images/' . $match->face_card) : 'default_image_url',
                ];
            });

        return view('pages.profileDetail', compact('person', 'slides', 'matches'));
    }
}
