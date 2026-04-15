<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::resource('products', ProductController::class);
Route::get('/sync-products', [ProductController::class, 'sync'])->name('products.sync');
