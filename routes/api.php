<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;


Route::apiResource('products', ProductController::class);
Route::patch('/products/{id}/status', [ProductController::class, 'changeStatus']);

