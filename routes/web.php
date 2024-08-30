<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RecipesController;
use App\Http\Controllers\Admin\CategoriesController;

Route::get('/', function () {
    return view('pages.customer.index');
});

Route::prefix('admin')->group(function () {
    Route::get('/giris', [AuthController::class, 'adminLoginIndex'])->name('admin.login');
    Route::get('/', [HomeController::class, 'index'])->name('admin.index');
    Route::get('/kullanicilar', [HomeController::class, 'adminUsersIndex'])->name('admin.users');
    Route::get('/tarifler', [RecipesController::class, 'index'])->name('admin.recipes');
    Route::get('/tarif/ekle', [RecipesController::class, 'create'])->name('admin.recipes.add');
    Route::get('/tarif/duzenle/{id}', [RecipesController::class, 'show'])->name('admin.recipes.edit');
    Route::get('/kategoriler', [CategoriesController::class, 'index'])->name('admin.categories');
    Route::get('/kategori/{id}', [CategoriesController::class, 'show'])->name('admin.category.recipes');
    Route::get('/carousel/fotograflar', [HomeController::class, 'allCarouselsIndex'])->name('admin.carousel.photos');
    Route::get('/carousel/ekle', [HomeController::class, 'addCarouselIndex'])->name('admin.carousel.add');
    Route::get('/carousel/duzenle/{id}', [HomeController::class, 'editCarouselPhoto'])->name('admin.carousel.edit');
});

require __DIR__ . '/auth.php';
