<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkoutController;
// use App\Models\User;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', [UserController::class, 'show']);

// user partecipa a workout - index
Route::middleware(['auth:sanctum'])->get('/user/runs/workouts', [UserController::class, 'userRunsWorkoutsIndex']);

// user ha workout
Route::middleware(['auth:sanctum'])->get('/user/{user}/workouts', [UserController::class, 'userWorkouts']);

// user partecipa a workout - post
Route::middleware(['auth:sanctum'])->post('/user/runs/workouts/{workout}', [UserController::class, 'userRunsWorkoutsPost']);

Route::apiResource('workouts', WorkoutController::class);
