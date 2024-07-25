<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AgendaController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Routes yang dilindungi oleh middleware auth:sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    // Route untuk mengambil detail pengguna
    Route::get('user', [UserController::class, 'fetch']);

    // Route untuk memperbarui profil pengguna
    Route::post('user', [UserController::class, 'updateProfile']);

    // Route untuk memperbarui foto pengguna
    Route::post('user/photo', [UserController::class, 'updatePhoto']);

    // Route untuk logout pengguna
    Route::post('logout', [UserController::class, 'logout']);

    // Route untuk mengambil semua data Agenda
    // Route::get('/agendas', [AgendaController::class, 'index']);
    Route::resource('/agendas', AgendaController::class);
});

// Route untuk proses login pengguna
Route::post('/login', [UserController::class, 'login']);

// Route untuk proses registrasi pengguna
Route::post('/register', [UserController::class, 'register']);

// Route untuk mengambil semua data ruangan (route publik)
Route::get('/rooms', [RoomController::class, 'index']);
