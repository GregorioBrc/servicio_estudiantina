<?php

namespace Database\Factories;

use App\Models\usuario_inventario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class usuario_inventarioFactory extends Factory
{
    protected $model = usuario_inventario::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'correo' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
        ];
    }
}
