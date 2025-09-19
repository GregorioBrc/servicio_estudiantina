<?php

namespace Database\Factories;

use App\Models\estante;
use App\Models\partitura;
use App\Models\usuario_inventario;
use Illuminate\Database\Eloquent\Factories\Factory;

class prestamoFactory extends Factory
{
    protected $model = \App\Models\prestamo::class;

    public function definition(): array
    {
        return [
            'descripcion' => fake()->sentence(),
            'usuario_inventario_id' => usuario_inventario::factory(),
            'partitura_id' => partitura::factory(),
            'estante_id' => estante::factory(),
        ];
    }
}
