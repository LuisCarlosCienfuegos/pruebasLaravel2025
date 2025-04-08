<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('posts.index');
});

Route::resource('posts', PostController::class);

use App\Http\Controllers\UserController;
// Route::resource('users', UserController::class);

Route::resource('users', UserController::class);
Route::post('users/generate-test-users', [UserController::class, 'generateTestUsers'])
    ->name('users.generateTestUsers');
