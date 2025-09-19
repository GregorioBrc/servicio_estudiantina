<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class tipo_contribucionFactory extends Factory
{
    protected $model = \App\Models\tipo_contribucion::class;

    public function definition(): array
    {
        return [
            'nombre_contribucion' => fake()->randomElement(['Compositor', 'Arreglista', 'Letrista', 'Transcriptor']),
        ];
    }
}
