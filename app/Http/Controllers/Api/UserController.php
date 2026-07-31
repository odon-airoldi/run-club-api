<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function show(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    // user ha workout
    public function userWorkouts(User $user)
    {
        $userWorkouts = $user->workouts()->latest()->get();
        return response()->json($userWorkouts);
    }

    // user partecipa a workout index
    public function userRunsWorkoutsIndex(Request $request)
    {
        $userRunsWorkouts = $request->user()->runsWorkouts()->get();
        return response()->json($userRunsWorkouts);
    }

    // user partecipa a workout post
    public function userRunsWorkoutsPost(Request $request, Workout $workout)
    {
        $user = $request->user();

        // se esista già la relazione user workout rimuovila
        if ($user->runsWorkouts()->where('workout_id', $workout->id)->exists()) {
            $user->runsWorkouts()->detach($workout);
        } else {
            $user->runsWorkouts()->attach($workout);
        }
        return response()->json(
            $workout->usersRun
        );
    }
}
