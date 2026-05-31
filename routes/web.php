<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Laravel Starter Kit Routes
|--------------------------------------------------------------------------
|
| Here are the routes for Laravel Starter Kit including user management
| and documentation pages. These routes are automatically registered
| during the installation process.
|
*/

// Laravel Starter Kit Routes: BEGIN
Route::name('starter-kit.')->group(function (): void {
    // User Management Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::delete('/users/reset-data', [UserController::class, 'destroyAll'])->name('users.reset-data');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Documentation Route
    Route::view('/documentation', 'documentation.index')->name('documentation.index');
});
// Laravel Starter Kit Routes: END
