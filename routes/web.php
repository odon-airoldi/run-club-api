<?php

use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/esercizio', function () {
    return view('esercizio');
});

Route::resource('workouts', WorkoutController::class);
// ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
