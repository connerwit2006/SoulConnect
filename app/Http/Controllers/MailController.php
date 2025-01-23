<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendVerificationEmail($user) 
    {
        $userName = $user->name;
        $userEmail = $user->email;

        Mail::send('mails.verifyEmail', ['userName' => $userName], function ($message) use ($userEmail) {
            $message->to($userEmail);
            $message->subject('Please verify your email address');
        });

        return redirect(route('dashboard'))->with('message', 'Verification email sent!');
    }

    public function verifyEmail(Request $request) 
    {
        // dd('Email Verified');
        $user = $request->user();
        $user->email_verified = true;

        // dd($user);

        $user->update();

        return redirect(route('dashboard'))->with('message', 'Email Verified!');
    }
}
