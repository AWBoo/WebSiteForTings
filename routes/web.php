<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::post('/follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);

// Route::get('/', [App\Http\Controllers\ImagePostController::class, 'index']);
Route::get('/ip/create', [App\Http\Controllers\ImagePostController::class, 'create']);
Route::post('/ip', [App\Http\Controllers\ImagePostController::class, 'store']);
Route::get('/ip/{post}', [App\Http\Controllers\ImagePostController::class, 'show']);


Route::post('/tp', [App\Http\Controllers\TextPostController::class, 'store']);
Route::get('/tp/{post}', [App\Http\Controllers\TextPostController::class, 'show']);

Route::get('/', [App\Http\Controllers\PostController::class, 'index']);

Route::post('/comments/{postType}/{postId}', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');


Route::get('/profile/{user}', [App\Http\Controllers\UserProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\UserProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\UserProfilesController::class, 'update'])->name('profile.update');

Route::get('/search', [App\Http\Controllers\UserController::class, 'showSearchPage'])->name('search.page');
Route::get('/search/results', [App\Http\Controllers\UserController::class, 'search'])->name('search');

Route::get('/explore', [App\Http\Controllers\PostController::class, 'explore'])->name('explore');