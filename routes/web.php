<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/session-check', function () {
    return response()->json([
        'user' => auth()->guard()->user(),
        'session' => session()->all(),
    ]);
});

Route::get('/view', function () {
    return Inertia::render('Auth/ViewUser');
})->name('view');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return Inertia::render('Auth/Login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [UserController::class, 'get'])
            ->name('dashboard');

        Route::prefix('/user')->group(function () {
            Route::get('/{id}', [UserController::class,'get'])->name('view');
            Route::put('/{id}', [UserController::class,'update'])->name('edit');
            Route::delete('/{id}', [UserController::class,'delete'])->name('delete'); 
        });
    });

    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');
});



