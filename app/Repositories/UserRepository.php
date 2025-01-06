<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function storeUser(string $name, string $email, int $favouriteFoodId): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'favourite_food_id' => $favouriteFoodId,
        ]);
    }

    public function updateUser(User $user, string $name, string $email, ?int $favouriteFoodId = null): User
    {
        $user->update(
            array_filter([
                'name' => $name,
                'email' => $email,
                'favourite_food_id' => $favouriteFoodId,
            ])
        );

        return $user->refresh();
    }
}
