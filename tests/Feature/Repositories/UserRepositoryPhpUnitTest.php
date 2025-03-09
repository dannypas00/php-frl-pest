<?php

namespace Tests\Feature\Repositories;

use App\Models\Food;
use App\Models\User;
use App\Repositories\UserRepository;
use Tests\TestCase;

/**
 * @covers \App\Repositories\UserRepository
 */
class UserRepositoryPhpUnitTest extends TestCase
{
    /**
     * @dataProvider userData
     */
    public function test_it_can_create_a_new_user(
        string $name,
        string $email,
        string $favouriteFood
    ) {
        $food = Food::factory()->create(['name' => $favouriteFood]);

        $user = app(UserRepository::class)->storeUser($name, $email, $food->id);

        $this->assertDatabaseHas('users', [
            'name'              => $name,
            'email'             => $email,
            'favourite_food_id' => $food->id,
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
        $this->assertEquals($favouriteFood, $user->favouriteFood->name);
    }

    public static function userData(): array
    {
        return [
            'danny' => [
                'name'          => 'Danny',
                'email'         => 'dannypas@canvascompany.nl',
                'favouriteFood' => 'Sushi',
            ],
            'jelte' => [
                'name'          => 'Jelte',
                'email'         => 'jelte@canvascompany.nl',
                'favouriteFood' => 'Pasta',
            ]
        ];
    }
}
