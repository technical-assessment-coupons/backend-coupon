<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CategoryController ,BrandController};

Route::get('/', function (Request $request) {
    return response()->json([
        'message' => 'welcome to api'
    ]);
});

// Route::apiResource('categories', CategoryController::class)->only([
//     'index', 'show'
// ]);
// Route::apiResource('brands', BrandController::class)->only([
//     'index', 'show'
// ]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('categories', CategoryController::class)->only([
        'index', 'show'
    ]);
    Route::apiResource('brands', BrandController::class)->only([
        'index', 'show'
    ]);
});
