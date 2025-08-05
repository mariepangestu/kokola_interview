<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantProductController;
use App\Http\Controllers\StringSearchController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PlantProductController::class, 'index'])->name('plant_product.index');
Route::post('/plant-product/store', [PlantProductController::class, 'store'])->name('plant_product.store');
Route::get('/string-search', [StringSearchController::class, 'index'])->name('string_search.index');
Route::post('/string-search', [StringSearchController::class, 'search'])->name('string_search.process');

