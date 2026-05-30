<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Laravel Starter Kit Routes
|--------------------------------------------------------------------------
*/

Route::name('starter-kit.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});
