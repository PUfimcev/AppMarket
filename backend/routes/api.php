<?php

use App\Http\Controllers\Api\CategoriesApiController;
use App\Http\Controllers\Api\CategoryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('throttle:api')->group(function () {
    Route::get('categories', CategoriesApiController::class);
    Route::get('{category:slug}', CategoryApiController::class);
});
