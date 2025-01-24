<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendVerificationEmail($user) 
    {;
        $userName = $user->name;
        $userEmail = $user->email;

        $verificationUrl = route('verifyEmail', ['id' => $user->id]);

        Mail::send('mails.verifyEmail', ['userName' => $userName, 'verificationUrl' => $verificationUrl], function ($message) use ($userEmail) {
            $message->to($userEmail);
            $message->subject('Verifiëer je emailadres');
        });

        return redirect(route('dashboard'))->with('message', 'Verificatie email gestuurd!');
    }

    public function verifyEmail($id) 
    {
        $user = User::findOrFail($id);
    
        if ($user->email_verified) {
            return redirect(route('dashboard'))->with('message', 'Email is al geverifiëerd!');
        }
    
        $user->email_verified = true;
        $user->save();
    
        return redirect(route('dashboard'))->with('message', 'Email geverifiëerd!');
    }    

    public function sendBlockedUserLoginAttemptMail($email) 
    {
        Mail::send('mails.blockedUserLoginAttempt', [], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Login Attempt');
        });

        return redirect(route('dashboard'))->with('message', 'Geblokkeerde gebruiker login poging mail gestuurd!');
    }
}
