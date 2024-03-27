<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function () {
    return \Illuminate\Support\Facades\Auth::guard('sanctum')->user();
});

Route::post('auth/access-tokens',[\App\Http\Controllers\Api\AccessTokensController::class,'store']);

Route::delete('auth/access-tokens/{token?}',[\App\Http\Controllers\Api\AccessTokensController::class,'destroy'])
    ->middleware('auth:sanctum');
Route::middleware(['auth:sanctum','auth.admin'])->resource('product', \App\Http\Controllers\Api\ProdutController::class);
