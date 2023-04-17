<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

Route::get('/', function () {
    return view('pages.dashboard');
})->name('admin.dashboard');

// Recipes
Route::controller(RecipeController::class)->group(function () {
    route::middleware('auth')->group(function () {
        Route::prefix('recipes')->group(function () {
            Route::get('/', 'index')->name('admin.recipes.index');
            Route::get('/{recipe}', 'show')->name('admin.recipes.show');
            Route::delete('/{recipe}', 'destroy')->name('admin.recipes.destroy');
            // Route::get('/difficulty/{difficulty}', 'getRecipesByDifficulty')->name('recipes.difficulty');
            // Route::post('/', 'store')->name('recipes.store');
            // Route::put('/{recipe}', 'update')->name('recipes.update');
        });
    });
});