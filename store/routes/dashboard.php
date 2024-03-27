<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;



Route::group([
    'middleware' => 'auth:sanctum','auth.admin',
    'as' => 'dashboard.',
    'prefix' => 'admin/dashboard',
], function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/categories/trash',[CategoriesController::class,'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore',[CategoriesController::class,'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete',[CategoriesController::class,'forceDelete'])->name('categories.force-delete');

    Route::resource('/categories', CategoriesController::class);
    Route::resource('/products',ProductController::class);

    Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update'); // we use patch because route put must contains id

});

