<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Test first name',
            'last_name' => 'Test last name',
            'email' => 'test@example.com',
        ]);

        $this->call([
            UsersTableSeeder::class,
            WorkoutsTableSeeder::class
        ]);
    }
}
