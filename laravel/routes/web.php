<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

// Produtos
Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');
Route::post('/produtos', [ProductController::class, 'store'])->name('products.store');

// Categorias
Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categorias', [CategoryController::class, 'store'])->name('categories.store');
