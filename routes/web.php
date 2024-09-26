<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class,'store']);
Route::get('/products/{id}', [ProductController::class,'show']);
Route::put('/products/{id}', [ProductController::class,'update']);
Route::delete('/products/{id}', [ProductController::class,'destroy']);

Route::post('/products/{id}/review', [ReviewController::class,'store']);
