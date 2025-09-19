<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class autorFactory extends Factory
{
    protected $model = \App\Models\autor::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
        ];
    }
}
