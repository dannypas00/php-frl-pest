<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->has(Food::factory())->create();
    }
}
