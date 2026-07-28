<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkoutController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', [UserController::class, 'show']);


Route::middleware(['auth:sanctum'])->get('/user/{user}/workouts', [UserController::class, 'userWorkouts']);


Route::apiResource('workouts', WorkoutController::class);
