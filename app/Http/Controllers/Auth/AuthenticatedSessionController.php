<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Models\BlockedUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\MailController;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $formFields = $request->validated();

        $user = User::where('email', $formFields['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Ongeldig emailadres of wachtwoord.']);
        }

        $isBlocked = BlockedUser::where('blocked_user_id', $user->id)->exists();

        if ($isBlocked) {
            app(MailController::class)->sendBlockedUserLoginAttemptMail($formFields['email']);
            return redirect()->route('userBlocked')->with('error', 'Your account has been blocked.');
        }

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
