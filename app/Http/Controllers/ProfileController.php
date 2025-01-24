<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
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

// Update de user profiel informatie
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

$request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
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
}
