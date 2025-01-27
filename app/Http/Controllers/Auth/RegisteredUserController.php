<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Models\BlockedUser;
use App\Models\ReportedUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\MailController;

class RegisteredUserController extends Controller
{
    /**
     * Display the user's dashboard.
     */
    public function show(): View
    {
        $user = Auth::user();

        return view('pages.dashboard')->with('user', $user);
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   public function store(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'min:16'],
            'nickname' => ['required', 'string', 'max:255'],
            'one_liner' => ['required', 'string', 'max:255'],
            'appreciate' => ['required', 'string', 'max:255'],
            'looking_for' => ['required', 'string', 'max:255'],
            'facecard' => ['nullable', 'max:2048'],
            'gender' => ['required'],
            'looking_for_gender' => ['required'],
            'dob' => ['required', 'date', 'before:-18 years'],
            'postcode' => ['required', 'string', 'max:255'],
            'relationship_type' => ['required', 'string', 'max:255'],
            'terms' => ['required', 'accepted'],
        ]);        

        $formFields['terms'] = $request->has('terms') ? true : false;
        $formFields['password'] = Hash::make($formFields['password']);
        $formFields['facecard'] = $request->hasFile('facecard') 
            ? $request->file('facecard')->store('facecards', 'public') 
            : null;

        $user = User::create($formFields);

        $mailController = new MailController();
        $mailController->sendVerificationEmail($user);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard'))->with('message', 'User registered!');
    }

    // Fetch Users List
    public function fetchUsersList(): View
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $blockedStatuses = [];
        $reportedUsers = [];

        foreach ($users as $user) {
            $blockedStatuses[$user->id] = BlockedUser::where('blocked_user_id', $user->id)->exists();

            $reportedUsers[$user->id] = ReportedUser::where('reported_user_id', $user->id)
            ->where('user_id', Auth::user()->id)
            ->exists();
        }


        return view('pages.users-list')->with([
            'users' => $users,
            'blockedStatuses' => $blockedStatuses,
            'reportedUsers' => $reportedUsers
        ]);
    }

    // Show Blocked Page
    public function showUserBlockedPage()
    {
        return view('pages.user-blocked');
    }

    // Report User
    public function reportUser($id): RedirectResponse
    {
        $formFields = [];
        $formFields['user_id'] = Auth::id();
        $formFields['reported_user_id'] = $id;

        ReportedUser::create($formFields);
        $timesReported = ReportedUser::where('reported_user_id', '=', $id)->count();

        if ($timesReported >= 3) {
            BlockedUser::create([
                'blocked_user_id' => $id,
                'blocked_by_user_id' => Auth::id()
            ]);
        }

        return redirect(route('usersList'))->with('message', 'Gebruiker gerapporteerd!');
    }

    // Block User
    public function blockUser($id): RedirectResponse
    {
        // dd($id);
        $user = User::find($id);

        // dd($user->id, Auth::id());

        $formFields = [
            'blocked_user_id' => $user->id,
            'blocked_by_user_id' => Auth::id()
        ];

        BlockedUser::create($formFields);

        return redirect(route('usersList'))->with('message', 'User blocked!');
    }

    public function unblockUser($id): RedirectResponse
    {
        $user = User::find($id);

        BlockedUser::where('blocked_user_id', $user->id)->delete();

        return redirect(route('usersList'))->with('message', 'User unblocked!');
    }
}
