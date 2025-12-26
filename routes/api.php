<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CategoryController ,BrandController , AuthController};

Route::get('/', function (Request $request) {
    return response()->json([
        'message' => 'welcome to api'
    ]);
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'meUser']);
    Route::post('/log-out', [AuthController::class, 'logOut']);
    Route::apiResource('categories', CategoryController::class)->only([
        'index', 'show'
    ]);
    Route::apiResource('brands', BrandController::class)->only([
        'index', 'show'
    ]);
});
