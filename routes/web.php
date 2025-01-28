<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('pages.welcome');
});

/**
Route::get('/detail/{id}', function ($id) {
    return view('pages.profileDetail', ['id' => $id]);
});
 */

Route::get('/detail/{id}', [ProfileController::class, 'show'])->name('profile.show');

// Show Dashboard
Route::get('/dashboard', [MatchingController::class, 'dashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/gallery/upload', [GalleryController::class, 'store'])->name('gallery.upload');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');
    Route::get('/profile/{id}', [MatchingController::class, 'profileDetail'])->name('profile.detail');

    //like system routes
    Route::get('/profiles', [LikeController::class, 'index'])->name('profiles.index');
    Route::get('/profiles/fetch', [LikeController::class, 'fetchProfiles'])->name('profiles.fetch');
    Route::post('/like', [LikeController::class, 'interact'])->name('like.interact');
    Route::get('/liked-by', [LikeController::class, 'likedBy'])->name('liked.by');
    Route::post('/like-back', [LikeController::class, 'likeBack'])->name('like.likeBack');
    Route::delete('/ignore', [LikeController::class, 'ignore'])->name('like.ignore');
    Route::get('/liked-users', [LikeController::class, 'likedUsers'])->name('like.likedUsers');
    Route::post('/like/remove', [LikeController::class, 'removeLike'])->name('like.remove');
    Route::get('/mutual-likes', [LikeController::class, 'mutualLikes'])->name('mutual.likes');

    //match system routes
    Route::get('/matches', [MatchingController::class, 'findMatches']);
    Route::get('/topmatches', [MatchingController::class, 'findTopMatches']);

    //payment system routes 
    Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
    Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    //chat system routes
    Route::get('/chat/{receiverId}', [ChatController::class, 'showChat'])->name('chat.show');
    Route::get('/chat/{receiverId}/fetch', [ChatController::class, 'fetchMessages'])->name('chat.fetchMessages');
    Route::post('/chat/{receiverId}/send', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');
    Route::get('chat/{receiverId}', [ChatController::class, 'showChat'])->name('chat.showChat');

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
