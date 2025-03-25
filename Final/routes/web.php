<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AIRecipeController;

Route::middleware(['auth'])->group(function () {
    Route::resource('recipes', RecipeController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/suggest-recipe', [AIRecipeController::class, 'suggestRecipe'])->name('suggest.recipe');
Route::post('/recipes/prefill', [RecipeController::class, 'prefill'])->name('recipes.prefill');




require __DIR__.'/auth.php';
