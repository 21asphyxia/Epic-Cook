<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    // middleware guest group
    Route::middleware('guest')->group(function () {
        Route::get('login', 'getLogin')->name('login.page');
        Route::get('register', 'getRegister')->name('register.page');
        Route::get('forgot-password', 'forgotPassword')->name('forgot.password');
        Route::get('reset-password/{token}', 'resetPassword')->name('reset.page');
        Route::post('reset-password', 'resetPassword')->name('password.reset');   
        Route::post('login', 'login')->name('login');
        Route::post('register', 'register')->name('register');
        Route::post('forgot-password', 'forgotPassword')->name('password.email');
        Route::post('reset-password', 'resetPassword')->name('password.update');
    });
    Route::post('logout', 'logout');
});