<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class instrumentoFactory extends Factory
{
    protected $model = \App\Models\instrumento::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->randomElement(['Violín', 'Viola', 'Cello', 'Contrabajo', 'Flauta', 'Clarinete', 'Guitarra', 'Mandolina']),
            'tipo' => fake()->randomElement(['Cuerda Frotada', 'Cuerda Pulsada', 'Viento Madera', 'Percusión']),
        ];
    }
}
