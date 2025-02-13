<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
}); 


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/user')
        ->middleware('admin')
        ->group(function () {
            Route::get('/{id?}', [UserController::class,'get']);
            Route::put('/{id}', [UserController::class,'update']);
            Route::delete('/{id}', [UserController::class,'delete']);            
        });

    Route::post('/logout', [UserController::class, 'logout']);
});
