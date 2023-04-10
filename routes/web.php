<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\UserController;
use App\Models\Recipe;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(UserController::class)->group(function () {
    Route::post('profile', 'updateProfile')->middleware('auth:api');
});

Route::controller(RecipeController::class)->group(function () {
    Route::prefix('recipes')->group(function () {
        Route::get('/', 'index')->name('app.recipes');
        Route::get('/{recipe}', 'show')->name('recipes.show');
        Route::get('/difficulty/{difficulty}', 'getRecipesByDifficulty')->name('recipes.difficulty');
        Route::post('/', 'store')->name('recipes.store');
        Route::put('/{recipe}', 'update')->name('recipes.update');
        Route::delete('/{recipe}', 'destroy')->name('recipes.destroy');
    });
});