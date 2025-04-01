<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Auth::routes();

// Follow Route
Route::post('/follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);

// Image Post Routes
Route::get('/ip/create', [App\Http\Controllers\ImagePostController::class, 'create']);
Route::post('/ip', [App\Http\Controllers\ImagePostController::class, 'store']);
Route::get('/ip/{post}', [App\Http\Controllers\ImagePostController::class, 'show']);

// Text Post Routes
Route::post('/tp', [App\Http\Controllers\TextPostController::class, 'store']);
Route::get('/tp/{post}', [App\Http\Controllers\TextPostController::class, 'show']);

// Main Post Routes (explore, etc.)
Route::get('/', [App\Http\Controllers\PostController::class, 'index']);
Route::get('/explore', [App\Http\Controllers\PostController::class, 'explore'])->name('explore');

// Like Routes
Route::post('/like/{postType}/{postId}', [App\Http\Controllers\PostController::class, 'likePost']);
Route::get('/like/{postType}/{postId}/count', [App\Http\Controllers\PostController::class, 'getLikeCount']);

// Comment Routes
Route::post('/comments/{postType}/{postId}', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

// User Profile Routes
Route::get('/profile/{user}', [App\Http\Controllers\UserProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\UserProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\UserProfilesController::class, 'update'])->name('profile.update');

// Search Routes
Route::get('/search', [App\Http\Controllers\UserController::class, 'showSearchPage'])->name('search.page');
Route::get('/search/results', [App\Http\Controllers\UserController::class, 'search'])->name('search');
