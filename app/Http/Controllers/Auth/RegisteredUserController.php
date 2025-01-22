<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('pages.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'min:16'],
            'nickname' => ['required', 'string', 'max:255'],
            'oneliner' => ['required', 'string', 'max:255'],
            'appreciate' => ['required', 'string', 'max:255'],
            'looking_for' => ['required', 'string', 'max:255'],
            'face_card' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'gender' => ['required'],
            'lookingforgender' => ['required'],
            'dob' => ['required', 'date', 'before:-18 years'],
            'postcode' => ['required', 'string', 'max:255'],
            'relationshiptype' => ['required', 'string', 'max:255'],
            'terms' => ['required', 'accepted'],
        ]);        

        $formFields['terms'] = $request->has('terms') ? true : false;
        $formFields['password'] = Hash::make($formFields['password']);
        $formFields['face_card'] = $request->hasFile('face_card') 
            ? $request->file('face_card')->store('face_cards', 'public') 
            : null;

        $user = User::create($formFields);

        $mailController = new MailController();
        $mailController->sendVerificationEmail($user);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
