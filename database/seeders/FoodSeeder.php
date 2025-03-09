<?php

namespace Database\Seeders;

use App\Enums\FoodType;
use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    private const array FOODS = [
        'Pizza'      => FoodType::FastFood,
        'Burgers'    => FoodType::FastFood,
        'Pasta'      => FoodType::Italian,
        'Salads'     => FoodType::Side,
        'Soup'       => FoodType::Side,
        'Noodles'    => FoodType::Side,
        'Sandwiches' => FoodType::Bread,
        'Sushi'      => FoodType::Seafood,
        'Tacos'      => FoodType::Mexican,
        'Burritos'   => FoodType::Mexican,
    ];

    public function run(): void
    {
        foreach (self::FOODS as $food => $type) {
            Food::create(['name' => $food, 'type' => $type]);
        }
    }
}
