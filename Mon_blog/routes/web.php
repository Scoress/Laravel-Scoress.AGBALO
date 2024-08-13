<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'register']) ->name('register');
Route::post('/register', [RegisterController::class, 'registerPost'])->name('register');
Route::get('/login', [RegisterController::class, 'login'])->name('login');
Route::post('/login', [RegisterController::class, 'loginPost'])->name('login');

Route::group(['middleware' => 'auth'], function () {
Route::get('/home', [HomeController::class, 'index']);
Route::delete('/logout', [RegisterController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
});
