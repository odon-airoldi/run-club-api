<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function show(Request $request)
    {
        return $request->user();
    }

    public function userWorkouts(User $user)
    {
        return response()->json(
            $user->workouts()->latest()->get()
        );
    }
}
