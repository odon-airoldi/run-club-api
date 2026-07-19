<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\Request;

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
    public function store(Request $request, User $user)
    {


        $data = $request->all();
        [$minutes, $seconds] = explode(':', $data['pace']);
        $pace = ($minutes * 60) + $seconds;

        $newWorkout = new Workout();
        $newWorkout->name = $data['name'];
        $newWorkout->description = $data['description'];
        $newWorkout->date_time = $data['date'];
        $newWorkout->place_city = $data['place_city'];
        $newWorkout->place_address = $data['place_address'];
        $newWorkout->buffer_time = $data['buffer_time'];
        $newWorkout->distance = $data['distance'];
        $newWorkout->pace = $pace;
        // $newWorkout->user_id = $data[''];
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
