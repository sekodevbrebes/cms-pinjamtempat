<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;

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

    Route::resource('/agenda', AgendaController::class);

    Route::resource('/dashboard', DashboardController::class);
});