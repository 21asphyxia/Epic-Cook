<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    // middleware guest group
    Route::middleware('guest')->group(function () {
        Route::get('login', function () {
            return view('auth.login');
        })->name('login');
        Route::post('login', 'login');
        Route::get('register', function () {
            return view('auth.register');
        })->name('register');
        Route::post('register', 'register');
        Route::get('forgot-password', function () {
            return view('auth.forgot-password');
        })->name('password.request');
        Route::post('forgot-password', 'forgotPassword')->name('password.email');
        Route::post('reset-password', 'resetPassword')->name('password.reset');
        Route::get('reset-password/{token}', 'getResetPassword')->name('password.reset');
        })->name('password.reset');   
    });
    Route::post('logout', 'logout');