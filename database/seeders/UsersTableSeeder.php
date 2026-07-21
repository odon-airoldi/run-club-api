<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $newUser = new User();
        $newUser->name = 'Odon';
        $newUser->email = 'odon.airoldi@gmail.com';
        $newUser->password = Hash::make('password');
        $newUser->role = 'admin';
        $newUser->save();

        for ($i = 0; $i < 8; $i++) {
            $newUser = new User();
            $newUser->name = $faker->name();
            $newUser->email = $faker->email();
            $newUser->password = Hash::make('password');
            $newUser->save();
        }
    }
}
