<?php

use App\Http\Controllers\Api\CarouselPhotoController;
use App\Http\Controllers\Api\CustomerAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecipesController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/app')->group(function () {

    Route::get('/recipes', [RecipesController::class, 'allRecipes']);
    Route::get('/recipe/{id}', [RecipesController::class, 'recipeDetails']);
    Route::post('/save/recipe', [RecipesController::class, 'saveCustomerRecipe']);
    Route::get('/categories', [RecipesController::class, 'allCategories']);
    Route::get('/category/{id}', [RecipesController::class, 'categoryRecipes']);
    Route::get('/popular_recipes', [RecipesController::class, 'popularRecipes']);
    Route::get('/carousel_photos', [CarouselPhotoController::class, 'carouselPhotos']);

    Route::prefix('/customer')->group(function () {
       Route::post('/register', [CustomerAuthController::class, 'customerRegister']);
       Route::post('/login', [CustomerAuthController::class, 'customerLogin']);
       Route::post('/logout', [CustomerAuthController::class, 'customerLogout']);
    });
});
