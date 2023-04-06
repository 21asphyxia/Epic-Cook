<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    // middleware guest group
    Route::middleware('guest')->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('forgot-password', 'forgotPassword')->name('password.email');
        Route::post('reset-password', 'resetPassword')->name('password.update');
        Route::get('reset-password/{token}', function (string $token) {
            return $token;
        })->middleware('guest')->name('password.reset');   
    });
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(UserController::class)->group(function () {
    Route::post('profile', 'updateProfile')->middleware('auth:api');
});

// Recipes
Route::controller(RecipeController::class)->group(function () {
    Route::prefix('recipes')->group(function () {
        Route::get('/', 'index');
        Route::get('/{recipe}', 'show');
        Route::get('/difficulty/{difficulty}', 'getRecipesByDifficulty');
        Route::post('/', 'store');
        Route::put('/{recipe}', 'update');
        Route::delete('/{recipe}', 'destroy');
    });
});
