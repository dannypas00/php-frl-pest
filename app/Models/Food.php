<?php

namespace App\Models;

use App\Enums\FoodType;
use Database\Factories\FoodFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    /** @use HasFactory<FoodFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    /** @codeCoverageIgnore */
    protected function casts(): array
    {
        return [
            'type' => FoodType::class,
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'favourite_food_id');
    }
}
