<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkoutController;
// use App\Models\User;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 00 user autenticato corrente
Route::middleware(['auth:sanctum'])->get('/user', [UserController::class, 'me']);

// 01 user
Route::middleware(['auth:sanctum'])->get('/users/{user}', [UserController::class, 'show']);

// 02 users list
Route::middleware(['auth:sanctum', 'role:admin'])->get('/users', [UserController::class, 'index']);

// 04 user partecipa a workout - index
Route::middleware(['auth:sanctum'])->get('/user/runs/workouts', [UserController::class, 'userRunsWorkoutsIndex']);

// 03 user ha workout
Route::middleware(['auth:sanctum'])->get('/user/{user}/workouts', [UserController::class, 'userWorkouts']);

// 05 user partecipa a workout - post
Route::middleware(['auth:sanctum'])->post('/user/runs/workouts/{workout}', [UserController::class, 'userRunsWorkoutsPost']);

// api workouts
Route::apiResource('workouts', WorkoutController::class);
