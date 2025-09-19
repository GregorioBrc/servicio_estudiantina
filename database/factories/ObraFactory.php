<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class obraFactory extends Factory
{
    protected $model = \App\Models\obra::class;

    public function definition(): array
    {
        return [
            'titulo' => ucwords(fake()->words(3, true)),
            'anio' => fake()->numberBetween(1700, 2024),
        ];
    }
}
