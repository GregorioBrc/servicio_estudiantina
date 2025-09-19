<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class estanteFactory extends Factory
{
    protected $model = \App\Models\estante::class;

    public function definition(): array
    {
        return [
            'gaveta' => fake()->unique()->numberBetween(1, 100),
        ];
    }
}
