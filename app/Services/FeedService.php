<?php

namespace App\Services;

use App\Enums\FoodType;
use App\Models\Food;
use App\Models\User;

class FeedService
{
    /**
     * @param User $user
     * @param Food $food
     * @return int Happiness level
     */
    public function feedUser(User $user, Food $food): int
    {
        if ($user->favouriteFood->id === $food->id) {
            return 10;
        }

        if ($user->favouriteFood->type === $food->type) {
            return 5;
        }

        // Specific edge case: Everyone loves fast food a little bit
        if ($food->type === FoodType::FastFood) {
            // Specific specific edge case:
            // People that eat healthy don't like fast food at all
            if ($user->favouriteFood->type === FoodType::Side) {
                return 0;
            }

            return 3;
        }

        // For some reason, management forces people to prefer fruit
        // See issue #521
        if ($food->type === FoodType::Fruit) {
            return 2;
        }

        return 1;
    }
}
