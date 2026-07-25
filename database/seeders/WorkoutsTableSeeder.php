<?php

namespace Database\Seeders;

use App\Models\Workout;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkoutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 8; $i++) {
            $newWorkout = new Workout();
            $newWorkout->name = $faker->sentence(8);
            $newWorkout->description = $faker->sentence(32);
            $newWorkout->date_time = $faker->dateTimeBetween('+1week', '+1 month');
            $newWorkout->place_city = $faker->city();
            $newWorkout->place_address = $faker->streetAddress();
            $newWorkout->buffer_time = $faker->numberBetween(0, 6) * 5;
            $newWorkout->distance = $faker->numberBetween(5, 40);
            $newWorkout->pace = $faker->numberBetween(16, 24) * 15;
            $newWorkout->user_id = $faker->numberBetween(1, 8);
            $newWorkout->save();
        }
    }
}
