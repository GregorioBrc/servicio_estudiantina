<?php

namespace Database\Seeders;
use App\Models\autor;
use App\Models\estante;
use App\Models\instrumento;
use App\Models\obra;
use App\Models\partitura;
use App\Models\tipo_contribucion;
use App\Models\User;
use App\Models\usuario_inventario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Factory_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- 1. Crear datos maestros e independientes ---
        User::factory(10)->create(); // Usuarios de la aplicación
        $autores = autor::factory(20)->create();
        $instrumentos = instrumento::factory(15)->create();
        $estantes = estante::factory(10)->create();
        $usuariosInventario = usuario_inventario::factory(5)->create();

        // Crear los tipos de contribución fijos
        $compositor = tipo_contribucion::create(['nombre_contribucion' => 'Compositor']);
        $arreglista = tipo_contribucion::create(['nombre_contribucion' => 'Arreglista']);
        $letrista = tipo_contribucion::create(['nombre_contribucion' => 'Letrista']);
        $tiposDeContribucion = collect([$compositor, $arreglista, $letrista]);

        // --- 2. Crear Obras y sus Partituras ---
        $obras = obra::factory(50)->create()->each(function ($obra) use ($instrumentos, $autores, $tiposDeContribucion) {
            // Crear entre 1 y 5 partituras únicas por obra
            $numeroDePartituras = rand(1, 5);
            $instrumentosDisponibles = $instrumentos->shuffle(); // Barajar instrumentos para mayor aleatoriedad

            // Tomar solo los primeros N instrumentos para evitar duplicados
            $instrumentosSeleccionados = $instrumentosDisponibles->take($numeroDePartituras);

            foreach ($instrumentosSeleccionados as $instrumento) {
                partitura::factory()->create([
                    'obra_id' => $obra->id,
                    'instrumento_id' => $instrumento->id,
                ]);
            }

            // Asignar entre 1 y 2 autores a cada obra (relación a través de contribuciones)
            $autoresDeLaObra = $autores->random(rand(1, 2));
            foreach ($autoresDeLaObra as $autor) {
                $obra->autores()->attach($autor->id, [
                    'tipo_contribucion_id' => $tiposDeContribucion->random()->id
                ]);
            }
        });

        // --- 3. Llenar el inventario ---
        $partituras = partitura::all();
        foreach ($estantes as $estante) {
            // Asigna entre 5 y 15 partituras al azar a cada estante, con una cantidad.
            $partiturasParaEstante = $partituras->random(rand(5, 15));
            foreach ($partiturasParaEstante as $partitura) {
                // attach() nos permite agregar datos a la columna extra 'Cantidad'
                $estante->Partituras()->attach($partitura->id, ['Cantidad' => rand(1, 10)]);
            }
        }

        // --- 4. Relacionar Usuarios con Instrumentos ---
        User::all()->each(function ($user) use ($instrumentos) {
            // Cada usuario toca entre 1 y 3 instrumentos
            $user->Instrumentos()->attach($instrumentos->random(rand(1, 3))->pluck('id'));
        });

        // --- 5. Relacionar Autores con Instrumentos ---
        $autores->each(function ($autor) use ($instrumentos) {
            // Cada autor toca entre 1 y 3 instrumentos
            $autor->instrumentos()->attach($instrumentos->random(rand(1, 3))->pluck('id'));
        });

        // --- 6. Crear Préstamos ---
        // (Este es un ejemplo simple, la lógica real sería más compleja)
        for ($i = 0; $i < 20; $i++) {
            $partituraEnInventario = \App\Models\inventario::inRandomOrder()->first();
            if ($partituraEnInventario) {
               $fechaPrestamo = fake()->dateTimeBetween('-1 year', 'now');
               $estado = 'activo';
               $fechaDevolucion = null;

            // Aleatoriamente, marcamos la mitad de los préstamos como devueltos
            if (rand(0, 1) == 1) {
                $estado = 'inactivo';
                // La fecha de devolución es unos días/semanas después del préstamo
                $fechaDevolucion = fake()->dateTimeBetween($fechaPrestamo, 'now');
            }

            \App\Models\prestamo::factory()->create([
                'usuario_inventario_id' => $usuariosInventario->random()->id,
                'partitura_id'          => $partituraEnInventario->partitura_id,
                'estante_id'            => $partituraEnInventario->estante_id,
                'created_at'            => $fechaPrestamo,
                'updated_at'            => $fechaPrestamo,
                'estado'                => $estado, // <-- AÑADIDO
                'fecha_devolucion'      => $fechaDevolucion, // <-- AÑADIDO
            ]);
            }
        }

    }
}
