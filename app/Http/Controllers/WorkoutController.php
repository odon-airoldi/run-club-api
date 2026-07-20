<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workouts = Workout::all();

        return view('workout.workouts', compact('workouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workout.workout-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // [$minutes, $seconds] = explode(':', $data['pace']);
        // $pace = ($minutes * 60) + $seconds;

        $date_time = $data['date'] . ' ' . $data['time'];
        $pace = $data['pace_m'] * 60 + $data['pace_s'];
        $user_id = Auth::user()->id;

        $newWorkout = new Workout();
        $newWorkout->name = $data['name'];
        $newWorkout->description = $data['description'];
        $newWorkout->date_time = $date_time;
        $newWorkout->place_city = $data['place_city'];
        $newWorkout->place_address = $data['place_address'];
        $newWorkout->buffer_time = $data['buffer_time'];
        $newWorkout->distance = $data['distance'];
        $newWorkout->pace = $pace;
        $newWorkout->user_id = $user_id;

        $newWorkout->save();

        return redirect()->route('workouts.show', $newWorkout);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        return view('workout.workout', compact('workout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workout $workout)
    {
        return view('workout.workout-edit', compact('workout'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workout $workout)
    {
        $data = $request->all();

        $date_time = $data['date'] . ' ' . $data['time'];
        $pace = $data['pace_m'] * 60 + $data['pace_s'];

        $workout->name = $data['name'];
        $workout->description = $data['description'];
        $workout->date_time = $date_time;
        $workout->place_city = $data['place_city'];
        $workout->place_address = $data['place_address'];
        $workout->buffer_time = $data['buffer_time'];
        $workout->distance = $data['distance'];
        $workout->pace = $pace;
        $workout->save();

        return redirect()->route('workouts.show', $workout);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {
        $workout->delete();

        return redirect()->route('workouts.index');
    }
}
