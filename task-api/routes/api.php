<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;

// Rota pública de login
Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login');

// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    // Rotas de autenticação
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rotas de tasks
    Route::apiResource('tasks', TaskController::class)->except(['show', 'edit', 'create']);
});
