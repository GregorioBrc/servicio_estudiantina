<?php

namespace Database\Factories;

use App\Models\instrumento;
use App\Models\obra;
use Illuminate\Database\Eloquent\Factories\Factory;

class partituraFactory extends Factory
{
    protected $model = \App\Models\partitura::class;

    public function definition(): array
    {
        return [
            'url_pdf' => 'https://huggingface.co/Gregorio1502/Pruebas/resolve/main/Acto%20del%20viento%20flauta.pdf',
            'link_video' => 'https://youtube.com/watch?v=' . fake()->lexify('???????????'),
            'obra_id' => obra::factory(),
            'instrumento_id' => instrumento::factory(),
        ];
    }
}
