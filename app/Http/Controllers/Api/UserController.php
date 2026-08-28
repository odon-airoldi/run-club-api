<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // 00 user autenticato corrente
    public function me(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role
        ]);
    }

    // 01 user
    public function show(user $user)
    {
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            // 'email' => $user->email,
            // 'role' => $user->role
        ]);
    }

    // 02 users list
    public function index(Request $request)
    {
        $users = User::select('id', 'name', 'email', 'role', 'created_at')->with(['workouts:id,user_id', 'runsWorkouts:id,user_id'])->get();
        return response()->json($users);
    }

    // 03 user è propritario di workout
    public function userWorkouts(User $user)
    {
        $userWorkouts = $user->workouts()->withCount('usersRun')->orderBy('date_time', 'asc')->get();
        return response()->json($userWorkouts);
    }

    // 04 user partecipa a workout - index
    public function userRunsWorkoutsIndex(User $user)
    {
        $userRunsWorkouts = $user->runsWorkouts()->withCount('usersRun')->orderBy('date_time', 'asc')->get();
        return response()->json($userRunsWorkouts);
    }

    // 05 user partecipa a workout - post
    public function userRunsWorkoutsPost(Request $request, Workout $workout)
    {
        $user = $request->user();

        if ($workout->user_id === $user->id) {
            abort(403, 'Non puoi partecipare a un workout che hai creato');
        } else if ($workout->date_time < now()) {
            abort(403, 'Non puoi partecipare a un workout già concluso');
            // se esista già la relazione user workout rimuovila
        } else if ($user->runsWorkouts()->where('workout_id', $workout->id)->exists()) {
            $user->runsWorkouts()->detach($workout);
        } else {
            // altrimenti crea la relazione
            $user->runsWorkouts()->attach($workout);
        }

        return response()->json(
            // get per rifare la query e avere dati aggiornati e non cached
            $workout->usersRun()->get()
        );
    }

    // 06 user delete account
    public function destroy(User $user)
    {


        if (auth()->user()->role !== 'admin' && $user->id !== auth()->user()->id) {
            abort(403, 'Non autorizzato');
        }

        $user->delete();
        return response()->noContent();
    }
}
