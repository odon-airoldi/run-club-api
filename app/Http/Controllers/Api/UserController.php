<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
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
}
