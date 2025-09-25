<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubtipoInstrumento>
 */
class SubtipoInstrumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->randomElement(['Acústico', 'Eléctrico', 'Semi-acústico', 'Clásico', 'Moderno', 'Tradicional']),
            'descripcion' => fake()->sentence(),
            'instrumento_id' => \App\Models\instrumento::inRandomOrder()->first()->id ?? \App\Models\instrumento::factory()
        ];
    }
}
