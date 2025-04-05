<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
  Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
  Route::post('/', [AuthController::class, 'login']);

  Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
  Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
  Route::resource('posts', PostController::class);

  Route::resource('users', UserController::class);
  Route::get('editProfile', [UserController::class, 'edit_profile'])->name('editProfile');
  Route::put('updateProfile', [UserController::class, 'update_profile'])->name('updateProfile');

  Route::resource('categories', CategoryController::class);

  Route::resource('tags', TagController::class);

  Route::resource('comments', CommentController::class);

  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
