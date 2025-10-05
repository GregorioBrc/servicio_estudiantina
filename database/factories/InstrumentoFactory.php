<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class instrumentoFactory extends Factory
{
    protected $model = \App\Models\instrumento::class;

    protected static $combinacionesUsadas = [];

    public function definition(): array
    {
        // Definir combinaciones únicas de nombre y tipo
        $combinaciones = [
            ['Violín', 'Cuerda Frotada'],
            ['Viola', 'Cuerda Frotada'],
            ['Cello', 'Cuerda Frotada'],
            ['Contrabajo', 'Cuerda Frotada'],
            ['Flauta', 'Viento Madera'],
            ['Clarinete', 'Viento Madera'],
            ['Oboe', 'Viento Madera'],
            ['Fagot', 'Viento Madera'],
            ['Trompeta', 'Viento Metal'],
            ['Trombón', 'Viento Metal'],
            ['Tuba', 'Viento Metal'],
            ['Guitarra', 'Cuerda Pulsada'],
            ['Mandolina', 'Cuerda Pulsada'],
            ['Arpa', 'Cuerda Pulsada'],
            ['Piano', 'Percusión'],
            ['Xilófono', 'Percusión'],
            ['Batería', 'Percusión'],
            ['Maracas', 'Percusión'],
            ['Pandereta', 'Percusión'],
            ['Triángulo', 'Percusión']
        ];

        // Filtrar combinaciones que aún no se han usado
        $combinacionesDisponibles = array_values(array_filter($combinaciones, function($combo) {
            return !in_array($combo, self::$combinacionesUsadas);
        }));

        // Si no hay combinaciones disponibles, reiniciar (para casos de muchos registros)
        if (empty($combinacionesDisponibles)) {
            self::$combinacionesUsadas = [];
            $combinacionesDisponibles = $combinaciones;
        }

        // Seleccionar una combinación aleatoria de las disponibles
        $seleccion = fake()->randomElement($combinacionesDisponibles);

        // Marcar esta combinación como usada
        self::$combinacionesUsadas[] = $seleccion;

        return [
            'nombre' => $seleccion[0],
            'tipo' => $seleccion[1],
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function () {
            // Resetear las combinaciones usadas después de cada creación para evitar problemas
            // con otros tests o procesos
            self::$combinacionesUsadas = [];
        });
    }
}
