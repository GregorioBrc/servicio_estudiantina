<?php

namespace Database\Factories;

use App\Models\autor;
use App\Models\obra;
use App\Models\tipo_contribucion;
use Illuminate\Database\Eloquent\Factories\Factory;

class contribucionesFactory extends Factory
{
    protected $model = \App\Models\contribuciones::class;

    public function definition(): array
    {
        return [
            // Asigna IDs de modelos que ya existen.
            'autor_id' => autor::factory(),
            'tipo_contribucion_id' => tipo_contribucion::factory(),
            'obra_id' => obra::factory(),
        ];
    }
}
