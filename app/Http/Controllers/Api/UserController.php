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

        if ($request->boolean) {
            $workout->usersRun()->attach($user);
        } else {
            $workout->usersRun()->detach($user);
        }

        return response()->json(
            $request->boolean
            // [
            //     'user_id' => $user->id,
            //     'workout_id' => $workout_id
            // ]
        );
    }
}
