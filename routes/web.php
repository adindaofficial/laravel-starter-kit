<?php

// Laravel Starter Kit Routes: BEGIN
\Illuminate\Support\Facades\Route::name('starter-kit.')->group(function (): void {
    \Illuminate\Support\Facades\Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    \Illuminate\Support\Facades\Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    \Illuminate\Support\Facades\Route::patch('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    \Illuminate\Support\Facades\Route::post('/users/{user}/reset-password', [\App\Http\Controllers\UserController::class, 'resetPassword'])->name('users.reset-password');
    \Illuminate\Support\Facades\Route::delete('/users/reset-data', [\App\Http\Controllers\UserController::class, 'destroyAll'])->name('users.reset-data');
    \Illuminate\Support\Facades\Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    \Illuminate\Support\Facades\Route::view('/documentation', 'documentation.index')->name('documentation.index');
});
// Laravel Starter Kit Routes: END
