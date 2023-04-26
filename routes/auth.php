<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    // middleware guest group
    Route::middleware('guest')->group(function () {
        Route::get('login', 'getLogin')->name('login.page');
        Route::get('register', 'getRegister')->name('register.page');
        Route::post('login', 'login')->name('login');
        Route::post('register', 'register')->name('register');
    });
    Route::middleware('auth')->group(function () {
        Route::put('edit-password', 'updatePassword')->name('edit.password');
        Route::get('logout', 'logout')->name('logout');
    });
});
