<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;

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

Route::controller(RecipeController::class)->group(function () {
    Route::prefix('recipes')->group(function () {
        Route::middleware('auth')->group(function () {
            Route::get('/create', 'create')->name('app.recipes.create')->middleware('can:create recipes');
            Route::post('/', 'store')->name('app.recipes.store')->middleware('can:create recipes');
            Route::get('/{recipe}/edit', 'edit')->name('app.recipes.edit')->middleware('permission:update recipes|update own recipes');
            Route::put('/{recipe}', 'update')->name('app.recipes.update')->middleware('permission:update recipes|update own recipes');
            Route::delete('/{recipe}', 'destroy')->name('app.recipes.destroy')->middleware('permission:delete recipes|delete own recipes');
        });
        Route::get('/', 'allRecipes')->name('app.recipes');
        Route::get('/{recipe}', 'showRecipe')->name('app.recipes.show');
    });
});

Route::controller(CommentController::class)->group(function () {
    Route::prefix('comments')->group(function () {
        Route::middleware(['auth'])->group(function () {
            Route::post('/{recipe}', 'store')->name('comments.store')->middleware('can:create comments');
            Route::put('/{comment}', 'update')->name('comments.update')->middleware('can:update own comments');
            Route::delete('/{comment}', 'destroy')->name('comments.destroy')->middleware('permission:delete comments|delete own comments');
        });
    });
});

Route::controller(RatingController::class)->group(function () {
    Route::prefix('ratings')->group(function () {
        Route::middleware('auth')->group(function () {
            Route::post('/{recipe}', 'store')->name('recipe.rate.store')->middleware('can:create ratings');
            Route::put('/{rating}', 'update')->name('recipe.rate.update')->middleware('can:update own ratings');
        });
    });
});

Route::controller(ImageController::class)->group(function () {
    Route::prefix('images')->group(function () {
        Route::middleware('auth')->group(function () {
            Route::put('/{image}', 'setMain')->name('recipe.image.update')->middleware('permission:update recipes|update own recipes');
            Route::delete('/{image}', 'destroy')->name('recipe.image.destroy')->middleware('permission:update recipes|update own recipes');
        });
    });
});

// Route::controller(UserController::class)->group(function () {
//     Route::post('profile', 'updateProfile')->middleware('auth:api');
// });