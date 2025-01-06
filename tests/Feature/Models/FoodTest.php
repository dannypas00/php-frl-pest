<?php

use App\Models\Food;
use App\Models\User;

covers(Food::class);

it('can retrieve users through favourite food', function (Food $food): void {
    expect($food->users)
        ->toHaveCount(10)
        ->each->toBeInstanceOf(User::class)
        ->and($food->users->pluck('favourite_food_id'))
        ->each->toEqual($food->getKey());
})->with([
    fn() => Food::factory()->has(User::factory(10))->create()
]);

it('can create users through favourite food', function (string $name, string $email, string $favouriteFood): void {
    $food = Food::factory()->create(['name' => $favouriteFood]);

    $food->users()->create([
        'name' => $name,
        'email' => $email,
    ]);

    expect(User::pluck('favourite_food_id'))
        ->toHaveCount(1)
        ->each->toEqual($food->getKey());
})->with('user data');
