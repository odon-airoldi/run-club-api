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


    public function usersWorkouts(Request $request, Workout $workout)
    {
        $user = $request->user();

        if ($user->runsWorkouts()->where('workout_id', $workout->id)->exists()) {
            $user->runsWorkouts()->detach($workout);
            $prova = 'rimosso';
        } else {
            $user->runsWorkouts()->attach($workout);
            $prova = 'aggiunto';
        }

        return response()->json(
            $prova
        );
    }
}
