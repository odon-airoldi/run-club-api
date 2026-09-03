<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    // 00 user autenticato corrente
    public function me(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'picture' => $user->picture,
            'role' => $user->role
        ]);
    }

    // 01 user
    public function show(user $user)
    {
        $currentUser = auth()->user();

        $data = [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'picture' => $user->picture
        ];

        if ($currentUser->role === 'admin' || $currentUser->id === $user->id) {
            $data['email'] = $user->email;
        }

        return response()->json($data);
    }

    // 02 users list
    public function index(Request $request)
    {
        $users = User::select('id', 'first_name', 'last_name', 'email', 'picture', 'role', 'created_at')->with(['workouts:id,user_id', 'runsWorkouts:id,user_id'])->get();
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

    // 06 user update account
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'picture' => ['nullable', 'image', 'max:2048'], // max 2MB
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ]);

        // se user è admin o user modifica il suo profilo
        if ($request->user()->role === 'admin' || $request->user()->id === $user->id) {

            // gestisci il file solo se è stato effettivamente caricato
            if ($request->hasFile('picture')) {

                // elimina la vecchia immagine, se esiste, per non lasciare file orfani su disco
                if ($user->picture) {
                    Storage::disk('public')->delete($user->picture);
                }

                $validated['picture'] = $request->file('picture')->store('users', 'public');
            } else {
                // nessun nuovo file caricato: rimuove la chiave picture da validated
                unset($validated['picture']);
            }

            $user->update($validated);

            return response()->json($user, 200);
        } else {
            abort(403, 'Non autorizzato');
        }
    }

    // 07 user delete account
    public function destroy(User $user)
    {

        if (auth()->user()->role !== 'admin' && $user->id !== auth()->user()->id) {
            abort(403, 'Non autorizzato');
        }

        $user->delete();
        return response()->noContent();
    }
}
