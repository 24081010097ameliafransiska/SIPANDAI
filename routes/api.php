<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardStatsController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ResultController;
use App\Http\Controllers\Api\StudentController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/dashboard/stats', [DashboardStatsController::class, 'index']);
    Route::get('/dashboard/activities', [DashboardStatsController::class, 'activities']);

    Route::apiResource('exams', ExamController::class);

    Route::get('/results', [ResultController::class, 'index']);
    Route::get('/results/{result}', [ResultController::class, 'show']);

    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/students/{student}', [StudentController::class, 'show']);

});