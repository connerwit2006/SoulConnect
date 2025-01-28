<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\LikeController;

Route::get('/', function () {
    return view('pages.welcome');
});

Route::get('/detail/{id}', function ($id) {
    return view('pages.profileDetail', ['id' => $id]);
});

Route::get('/profile/{id}', [ProfileController::class, 'show'])->middleware('auth')->name('profile.show');

// Show Dashboard
Route::get('/dashboard', [RegisteredUserController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/gallery/upload', [GalleryController::class, 'store'])->name('gallery.upload');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');


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
    Route::get('/matches', [MatchingController::class, 'findMatches'])->name('matches.index');
    Route::get('/topmatches', [MatchingController::class, 'findTopMatches'])->name('matches.top');

    // Get Users List
    Route::get('/users/list', [RegisteredUserController::class, 'fetchUsersList'])->name('usersList');

    // Report User
    Route::get('/report/user/{id}', [RegisteredUserController::class, 'reportUser'])->name('reportUser');

    // Block User
    Route::get('/block/user/{id}', [RegisteredUserController::class, 'blockUser'])->name('blockUser');

    // Unblock User
    Route::get('/unblock/user/{id}', [RegisteredUserController::class, 'unBlockUser'])->name('unblockUser');
});

// Register User Page
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// Store User
Route::post('/users/store', [RegisteredUserController::class, 'store'])->name('storeUser');

// Send Verification Email to User
Route::get('/send-verification-email', [MailController::class, 'sendVerificationEmail'])->name('sendVerificationEmail');

// User Email Verification
Route::get('/email/verify/{id}', [MailController::class, 'verifyEmail'])->name('verifyEmail');

// Show User Blocked Page
Route::get('/user/blocked', [RegisteredUserController::class, 'showUserBlockedPage'])->name('userBlocked');

// Show Terms
Route::get('/terms', function () {
    return view('pages.terms');
});

require __DIR__.'/auth.php';
