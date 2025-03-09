<?php

use App\Models\Food;
use App\Models\User;
use App\Repositories\UserRepository;

use function Pest\Laravel\assertDatabaseHas;

covers(UserRepository::class);

it('can create a new user', function (
    string $name,
    string $email,
    string $favouriteFood
) {
    $food = Food::factory()
        ->create(['name' => $favouriteFood]);

    $user = app(UserRepository::class)
        ->storeUser($name, $email, $food->id);

    assertDatabaseHas('users', [
        'name'              => $name,
        'email'             => $email,
        'favourite_food_id' => $food->id,
    ]);

    expect($user)
        ->toBeInstanceOf(User::class)
        ->name->toEqual($name)
        ->email->toEqual($email)
        ->favouriteFood->name->toEqual($favouriteFood);
})->with('user data');

it(
    'can update a user with favourite food',
    function (User $user, string $name, string $email, string $favouriteFood) {
        $food = Food::factory()->create(['name' => $favouriteFood]);

        $returnedUser = app(UserRepository::class)
            ->updateUser($user, $name, $email, $food->id);

        assertDatabaseHas('users', [
            'id'                => $user->id,
            'name'              => $name,
            'email'             => $email,
            'favourite_food_id' => $food->id,
        ]);

        expect($returnedUser)
            ->toBeInstanceOf(User::class)
            ->name->toEqual($name)
            ->email->toEqual($email)
            ->favouriteFood->name->toEqual($favouriteFood);
    }
)
    ->with([fn () => User::factory()->create()])
    ->with('user data');

it('can update a user without favourite food', function (User $user) {
    $originalFoodId = $user->favourite_food_id;

    $returnedUser = app(UserRepository::class)
        ->updateUser($user, 'test', 'test');

    assertDatabaseHas('users', [
        'id'                => $user->id,
        'name'              => 'test',
        'email'             => 'test',
        'favourite_food_id' => $originalFoodId,
    ]);

    expect($returnedUser)
        ->toBeInstanceOf(User::class)
        ->name->toEqual('test')
        ->email->toEqual('test');
})->with([fn () => User::factory()->create()]);
