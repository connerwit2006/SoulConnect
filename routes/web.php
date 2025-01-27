<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\LikeController;


Route::get('/', function () {
    return view('pages.welcome');
});

Route::get('/detail/{id}', function ($id) {
    return view('pages.profileDetail', ['id' => $id]);
});

Route::get('/profile/{id}', [ProfileController::class, 'show'])->middleware('auth');

// Show Dashboard
Route::get('/dashboard', [RegisteredUserController::class, 'show'])->middleware('auth')->name('dashboard');

//Route::get('/dashboard', function () {
//    return view('pages.dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('dashboard', [RegisteredUserController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //like system routes
    Route::get('/profiles', [LikeController::class, 'index'])->name('profiles.index');
    Route::get('/profiles/fetch', [LikeController::class, 'fetchProfiles'])->name('profiles.fetch');
    Route::post('/like', [LikeController::class, 'interact'])->name('like.interact');
    Route::get('/liked-by', [LikeController::class, 'likedBy'])->name('liked.by');
    Route::post('/like-back', [LikeController::class, 'likeBack'])->name('like.likeBack');
    Route::delete('/ignore', [LikeController::class, 'ignore'])->name('like.ignore');
    Route::get('/liked-users', [LikeController::class, 'likedUsers'])->name('like.likedUsers');
    Route::post('/like/remove', [LikeController::class, 'removeLike'])->name('like.remove');


    //match system routes
    Route::get('/matches', [MatchingController::class, 'findMatches']);
    Route::get('/topmatches', [MatchingController::class, 'findTopMatches']);
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

// Report User
Route::get('/report/user/{id}', [RegisteredUserController::class, 'reportUser'])->name('reportUser');

// Show User Blocked Page
Route::get('/user/blocked', [RegisteredUserController::class, 'showUserBlockedPage'])->name('userBlocked');

// Block User
Route::get('/block/user/{id}', [RegisteredUserController::class, 'blockUser'])->middleware('auth')->name('blockUser');

// Unblock User
Route::get('/unblock/user/{id}', [RegisteredUserController::class, 'unBlockUser'])->middleware('auth')->name('unblockUser');

require __DIR__.'/auth.php';
