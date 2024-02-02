<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class)->except('show');
Route::get('categories/{category}/books', [CategoryController::class, 'show']);
Route::apiResource('books', BookController::class);
