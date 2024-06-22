<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
      Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/users', UserController::class);

    Route::resource('/rooms', RoomController::class);
});