<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegController;
use App\Http\Controllers\AuthController;

// главная страница
Route::view('/', 'home');

// приватная страница
Route::view('/private/', 'private.home')->middleware('auth')->name('private');

// регистрация пользователя
Route::get('/register', [RegController::class, 'index'])->name('register');
Route::post('/register', [RegController::class, 'create']);

// авторизация
Route::name('user.')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'check']);
    Route::get('/login_2fa', [AuthController::class, 'index_2fa'])->name('login_2fa');
    Route::post('/login_2fa', [AuthController::class, 'check_2fa']);
    Route::get('/logout', [AuthController::class, 'out'])->name('logout');
});
