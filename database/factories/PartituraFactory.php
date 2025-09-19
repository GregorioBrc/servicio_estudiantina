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
            'url_pdf' => fake()->slug() . '.pdf',
            'link_video' => 'https://youtube.com/watch?v=' . fake()->lexify('???????????'),
            'obra_id' => obra::factory(),
            'instrumento_id' => instrumento::factory(),
        ];
    }
}
