<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SdgController;
use Illuminate\Support\Facades\Route;

Route::name('public.')->group(function (): void {
    Route::get('/', [SdgController::class, 'index'])->name('home');
    Route::get('/food/{slug}', [SdgController::class, 'show'])->name('show');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::prefix('contributor')
    ->name('contributor.')
    ->middleware(['auth', 'role:admin,donator'])
    ->group(function (): void {
        Route::get('/inventory', [SdgController::class, 'inventory'])->name('inventory');
        Route::get('/create', [SdgController::class, 'create'])->name('create');
        Route::post('/store', [SdgController::class, 'store'])->name('store');
        Route::get('/{foodShare}/edit', [SdgController::class, 'edit'])->name('edit');
        Route::put('/{foodShare}', [SdgController::class, 'update'])->name('update');
        Route::delete('/{foodShare}', [SdgController::class, 'destroy'])->name('destroy');
    });

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function (): void {
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::put('/users/{user}/role', [AdminController::class, 'updateRole'])->name('users.role');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    });
