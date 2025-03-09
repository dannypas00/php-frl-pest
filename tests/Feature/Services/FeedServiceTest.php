<?php

use App\Enums\FoodType;
use App\Models\Food;
use App\Models\User;
use App\Services\FeedService;

it('determines the expected happiness level', function (
    Food $favouriteFood,
    Food $inputFood,
    int $expectedHappinessLevel
) {
    $user = User::factory()->recycle($favouriteFood)->create();

    expect(app(FeedService::class)->feedUser($user, $inputFood))
        ->toEqual($expectedHappinessLevel);
})
    ->with([
        'fed favourite food'                 => [
            fn () => Food::factory(['type' => FoodType::FastFood])->create(),
            fn () => Food::first(),
            10,
        ],
        'everyone loves fast food'           => [
            fn () => Food::factory(['type' => FoodType::Bread])->create(),
            fn () => Food::factory(['type' => FoodType::FastFood])->create(),
            3,
        ],
        'healthy eaters dont like fast food' => [
            fn () => Food::factory(['type' => FoodType::Side])->create(),
            fn () => Food::factory(['type' => FoodType::FastFood])->create(),
            0,
        ],
        'always prefer fruit' => [
            fn () => Food::factory(['type' => FoodType::Bread])->create(),
            fn () => Food::factory(['type' => FoodType::Fruit])->create(),
            2,
        ],
        'food doesnt match any criteria' => [
            fn () => Food::factory(['type' => FoodType::Bread])->create(),
            fn () => Food::factory(['type' => FoodType::Seafood])->create(),
            1,
        ],
    ]);
