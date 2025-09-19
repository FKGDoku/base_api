<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\V1\CategoryController;
use App\Http\Controllers\api\V1\PostsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::prefix('v1')->group(function () {
   Route::apiResource('/categories', CategoryController::class);
   Route::apiResource('/posts', PostsController::class);
});
