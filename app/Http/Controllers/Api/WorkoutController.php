<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $data = Workout::all();

        return response()->json([
            'success' => true,
            'results' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'date_time' => ['required', 'date'],
            'place_city' => ['required', 'string'],
            'place_address' => ['required', 'string'],
            'buffer_time' => ['required', 'integer', 'max:3599'],
            'distance' => ['required', 'integer', 'min:1'],
            'pace' => ['required', 'integer', 'max:3599'],
        ]);

        $validated['user_id'] = 1;

        $newWorkout = Workout::create($validated);

        return response()->json($newWorkout, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        $workout->load('runUsers');

        return response()->json([
            'success' => true,
            'results' => $workout
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workout $workout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {
        $workout->delete();

        return response()->noContent();
    }
}
