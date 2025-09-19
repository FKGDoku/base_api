<?php

use App\Http\Controllers\api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\V1\CategoryController;
use App\Http\Controllers\api\V1\PostsController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->middleware('throttle:RateLimit')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('v1')->middleware(['throttle:RateLimit','auth:sanctum'])->group(function () {
   Route::apiResource('/categories', CategoryController::class);
   Route::apiResource('/posts', PostsController::class);
   Route::post('/logout', [PostsController::class, 'logout']);
});
