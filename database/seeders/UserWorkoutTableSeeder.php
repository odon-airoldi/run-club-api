<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserWorkoutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::all();
        // $workouts = Workout::all();

        foreach ($users as $user) {

            $workouts = Workout::where('user_id', '!=', $user->id)
                ->inRandomOrder()
                ->limit(rand(0, 5))
                ->pluck('id')
                ->toArray();

            $user->runsWorkouts()->attach($workouts);
        }
    }
}
