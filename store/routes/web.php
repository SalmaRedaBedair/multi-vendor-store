<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->get('/', [HomeController::class,'index'])->name('home');

Route::resource('verify', \App\Http\Controllers\TwoFactorController::class);

Route::middleware(['auth','verified','two_factor'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('products',[ProductController::class,'index'])
->name('products.index');
Route::get('products/{product:slug}',[ProductController::class,'show'])
->name('products.show');

Route::resource('cart',CartController::class);

Route::post('paypal/webhook', function(){
    echo 'webhook';
});

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';


Route::get('test',[\App\Http\Controllers\TestController::class,'index'])->name('test.index');
