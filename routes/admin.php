<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;


// Recipes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', function () {
        return view('pages.admin.dashboard');
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
            // Route::get('/difficulty/{difficulty}', 'getRecipesByDifficulty')->name('recipes.difficulty');
            // Route::post('/', 'store')->name('recipes.store');
            // Route::put('/{recipe}', 'update')->name('recipes.update');
        });
    });
});
