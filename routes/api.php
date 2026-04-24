<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json(['message' => 'Api is working!']);
});

Route::prefix('auth')->group(function () {

    // Públicas
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::post('/register', [AuthController::class, 'register']);

    // Protegidas
    Route::middleware('auth:api')->group(function () {
        Route::post('/logoff', [AuthController::class, 'logoff']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});
