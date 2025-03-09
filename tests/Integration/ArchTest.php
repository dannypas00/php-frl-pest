<?php

declare(strict_types=1);

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray'])
    ->each->not->toBeUsed();

arch()->preset()
    ->laravel();

arch()->expect('App\\')
    ->classes()
    ->toUseStrictTypes()
    ->toUseStrictEquality();

arch('all controllers should be invokable')
    ->expect('App\\Http\\Controllers\\')
    ->classes()
    ->toBeInvokable();

arch('all models extend base model')
    ->expect(['App\\Models\\'])
    ->classes()
    ->toExtend('Illuminate\\Database\\Eloquent\\Model');

arch('all models use HasFactory trait')
    ->expect(['App\\Models\\'])
    ->classes()
    ->toUseTrait('Illuminate\\Database\\Eloquent\\Factories\\HasFactory');
