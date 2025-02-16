<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\Api\ProjectApiController;
use App\Http\Controllers\Api\AuthApiController;

Route::aliasMiddleware('jwt.auth', JwtMiddleware::class);

// Route Auth Api
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

// Route CRUD Api Proyek dengan Autentikasi
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/projects', [ProjectApiController::class, 'showAll']); // Semua proyek muncul
    Route::get('/projectsLogin', [ProjectApiController::class, 'showByLoginUser']); // Hanya memunculkan proyek yang dikerjakan oleh user yang sedang login
    Route::post('/projects', [ProjectApiController::class, 'store']);
    Route::put('/projects/{id}', [ProjectApiController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectApiController::class, 'delete']);

    // Extra
    Route::post('/logout', [AuthApiController::class, 'logout']);
});

 


