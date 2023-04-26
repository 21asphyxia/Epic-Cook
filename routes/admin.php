<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IngredientController;


// Recipes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.recipes.index');
    })->name('admin.dashboard');
    Route::controller(RecipeController::class)->group(function () {
        Route::prefix('recipes')->group(function () {
            Route::get('/', 'index')->name('admin.recipes.index');
            Route::get('/{recipe}', 'show')->name('admin.recipes.show');
            Route::delete('/{recipe}', 'destroy')->name('admin.recipes.destroy');
            Route::controller(CommentController::class)->group(function () {
                Route::prefix('{recipe}/comments')->group(function () {
                    Route::delete('/{comment}', 'destroy')->name('admin.comments.destroy')->middleware('can:delete all comments');
                    Route::get('/', 'index')->name('admin.recipe.comments');
                });
            });
        });
    });
    Route::controller(IngredientController::class)->group(function () {
        Route::prefix('ingredients')->group(function () {
            Route::get('/', 'index')->name('admin.ingredients.index');
            Route::post('/', 'store')->name('admin.ingredients.store');
            Route::get('/{ingredient}', 'show')->name('admin.ingredients.show');
            Route::put('/{ingredient}', 'update')->name('admin.ingredients.update');
            Route::delete('/{ingredient}', 'destroy')->name('admin.ingredients.destroy');
        });
    });

    Route::controller(UserController::class)->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', 'index')->name('admin.users.index');
            Route::get('/{user}', 'show')->name('admin.users.show');
            Route::put('/{user}', 'update')->name('admin.users.update');
            Route::delete('/{user}', 'destroy')->name('admin.users.destroy');
        });
    });
});
