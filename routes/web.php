<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [RecipeController::class, 'recentlyPopular'])->name('app.home');

Route::controller(UserController::class)->group(function () {
    Route::post('profile', 'updateProfile')->middleware('auth:api');
});

Route::controller(RecipeController::class)->group(function () {
    Route::prefix('recipes')->group(function () {
        Route::get('/', 'index')->name('app.recipes');
        Route::get('/{recipe}', 'showRecipe')->name('app.recipes.show');
        Route::get('/difficulty/{difficulty}', 'getRecipesByDifficulty')->name('recipes.difficulty');
        Route::post('/', 'store')->name('recipes.store');
        Route::put('/{recipe}', 'update')->name('recipes.update');
        Route::delete('/{recipe}', 'destroy')->name('recipes.destroy');
    });
});

Route::controller(CommentController::class)->group(function () {
    Route::prefix('comments')->group(function () {
        Route::post('/{recipe}', 'store')->name('comments.store');
        Route::put('/{comment}', 'update')->name('comments.update');
        Route::delete('/{comment}', 'destroy')->name('comments.destroy');
    });
});

Route::controller(RatingController::class)->group(function () {
    Route::prefix('ratings')->group(function () {
        Route::post('/{recipe}', 'store')->name('recipe.rate.store');
        Route::put('/{rating}', 'update')->name('recipe.rate.update');
    });
});