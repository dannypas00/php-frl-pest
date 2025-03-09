<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
//    /** @use HasFactory<UserFactory> */
//    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'favourite_food_id',
    ];

    public function favouriteFood(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
}
