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


    public function userWorkouts(User $user)
    {
        $userWorkouts = $user->workouts()->latest()->get();
        return response()->json($userWorkouts);
    }


    public function userRunsWorkouts(Request $request, Workout $workout)
    {
        $user = $request->user();

        $workout_id = $workout->id;

        $workout->usersRun()->attach($user);

        return response()->json(
            [
                'user_id' => $user->id,
                'workout_id' => $workout_id
            ]
        );
    }
}
