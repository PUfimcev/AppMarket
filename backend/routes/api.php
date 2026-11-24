<?php

use App\Http\Controllers\Api\TopCategoriesApiController;
use App\Http\Controllers\Api\CategoryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('throttle:api')->group(function () {
    Route::get('top-categories', TopCategoriesApiController::class);
    Route::get('{category:slug}', CategoryApiController::class);
});
