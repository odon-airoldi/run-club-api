<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Middleware;

class WorkoutController extends Controller
{

    /**
     * Display users workouts.
     */
    // public function workoutsUser(Request $request)
    // {
    //     return response()->json(
    //         $request->user()->workouts()->get()
    //     );
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workouts = Workout::withCount('usersRun')->orderBy('date_time', 'asc')->get();

        return response()->json($workouts);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[Middleware('auth:sanctum')] // protetto da metodo di autenticazione sanctum
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
            'user_id' => ['required', 'integer']
        ]);

        // $validated['user_id'] = 1;

        $newWorkout = Workout::create($validated);

        return response()->json($newWorkout, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        $workout->load(['user:id,name', 'usersRun:id,name']);

        return response()->json($workout);
    }

    /**
     * Update the specified resource in storage.
     */
    #[Middleware('auth:sanctum')] // protetto da metodo di autenticazione sanctum
    public function update(Request $request, Workout $workout)
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

        // prendo user da request
        $user = $request->user();

        // se user è admin o l'id di user è uguale a user_id di workout
        if ($user->role === 'admin' || $user->id === $workout->user_id) {
            $workout->update($validated);
            return response()->json($workout, 200);
        } else {
            abort(403, 'Non autorizzato');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    #[Middleware('auth:sanctum')] // protetto da metodo di autenticazione sanctum
    public function destroy(Workout $workout)
    {
        // non ho request uso auth
        $user = auth()->user();

        // se user non è admin e non è proprietario del workout non autorizzo
        if ($user->role !== 'admin' && $user->id !== $workout->user_id) {
            abort(403, 'Non autorizzato');
        }

        $workout->delete();
        return response()->noContent();
    }
}
