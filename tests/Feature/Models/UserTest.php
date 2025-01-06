<?php

use App\Models\Food;
use App\Models\User;
use function Pest\Laravel\assertDatabaseHas;

covers(User::class);

it('can retrieve the favourite food', function (User $user) {
    expect($user->favouriteFood)->toBeInstanceOf(Food::class);
})->with([fn() => User::factory()->create()]);

it('can attach the favourite food', function (User $user, Food $food) {
    $user->favouriteFood()->associate($food)->save();

    assertDatabaseHas('users', [
        'id' => $user->id,
        'favourite_food_id' => $food->id,
    ]);
})
    ->with([fn() => User::factory()->create()])
    ->with([fn() => Food::factory()->create()]);
