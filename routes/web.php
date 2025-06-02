<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\KoumnitController;
use App\Http\Controllers\KoumnitLikeController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;


Route::get('', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('koumnits', KoumnitController::class)->except(['index', 'show', 'create'])->middleware('auth');

Route::resource('koumnits', KoumnitController::class)->only('show');

Route::resource('koumnits.comments', CommentController::class)->only('store')->middleware('auth');

Route::resource('users', UserController::class)->only('show');

Route::resource('users', UserController::class)->only(['update', 'edit'])->middleware('auth');

Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');

Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

Route::post('koumnits/{koumnit}/like', [KoumnitLikeController::class, 'like'])->middleware('auth')->name('koumnits.like');

Route::post('koumnits/{koumnit}/unlike', [KoumnitLikeController::class, 'unlike'])->middleware('auth')->name('koumnits.unlike');

Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware(['auth', 'can:admin']);

require __DIR__ . '/auth.php';
