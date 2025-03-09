<?php

declare(strict_types=1);

use App\Models\Food;
use App\Repositories\UserRepository;

it('matches the snapshot', function (
    string $name,
    string $email,
    string $favouriteFood
): void {
    $food = Food::factory()
        ->create(['name' => $favouriteFood]);

    expect(
        app(UserRepository::class)->storeUser($name, $email, $food->id)
    )->toMatchSnapshot('user repository store');
})->with('user data');
