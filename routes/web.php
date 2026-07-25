<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::resource('workouts', WorkoutController::class)->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
