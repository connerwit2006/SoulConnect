<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MatchingController;


Route::get('/', function () {
    return view('pages.welcome');
});

Route::get('/profile/{id}', [ProfileController::class, 'show'])->middleware('auth');


Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Register User Page
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// Store User
Route::post('/users/store', [RegisteredUserController::class, 'store'])->name('storeUser');

// Send Verification Email to User
Route::get('/send-verification-email', [MailController::class, 'sendVerificationEmail'])->name('sendVerificationEmail');

// User Email Verification
Route::get('/email/verify/{id}', [MailController::class, 'verifyEmail'])->name('verifyEmail');

Route::get('/matches', [MatchingController::class, 'findMatches']);
Route::get('/topmatches', [MatchingController::class, 'findTopMatches']);

// Get Users List
Route::get('/users/list', [RegisteredUserController::class, 'fetchUsersList'])->name('usersList');

// Show User Blocked Page
Route::get('/user/blocked', [RegisteredUserController::class, 'showUserBlockedPage'])->name('userBlocked');

// Block User
Route::get('/block/user/{id}', [RegisteredUserController::class, 'blockUser'])->middleware('auth')->name('blockUser');

// Unblock User
Route::get('/unblock/user/{id}', [RegisteredUserController::class, 'unBlockUser'])->middleware('auth')->name('unblockUser');

require __DIR__.'/auth.php';
