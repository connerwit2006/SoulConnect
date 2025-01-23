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
        // Validate the request
        $request->validate([
            'one_liner' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date', 'before:-18 years'],
            'looking_for_gender' => 'required|string',
            'appreciate' => 'required|string',
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'relationship_type' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'postcode' => ['required', 'string', 'max:255'],
            // Add other validation rules here
        ]);

        // Update the user's profile information
        $user->one_liner = $request->input('one_liner');
        $user->dob = $request->input('dob');
        $user->looking_for_gender = $request->input('looking_for_gender');
        $user->nickname = $request->input('nickname');
        $user->relationship_type = $request->input('relationship_type');
        $user->gender = $request->input('gender');
        $user->appreciate = $request->input('appreciate');
        $user->postcode = $request->input('postcode');

        // Update other fields here
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
