<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    private const array FOODS = [
        'Pizza',
        'Burgers',
        'Pasta',
        'Salads',
        'Soup',
        'Sandwiches',
        'Sushi',
        'Tacos',
        'Burritos',
        'Noodles',
    ];

    public function run(): void
    {
        foreach (self::FOODS as $food) {
            Food::create(['name' => $food]);
        }
    }
}
