<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class contribuciones extends Pivot
{
    use HasFactory;

    protected $table = "contribuciones";
    public $timestamps = false;

    // Relación: Una contribución pertenece a un autor
    public function autor(): BelongsTo
    {
        return $this->belongsTo(autor::class, "autor_id");
    }

    // Relación: Una contribución pertenece a un tipo de contribución
    public function tipoContribucion(): BelongsTo
    {
        return $this->belongsTo(tipo_contribucion::class, "tipo_contribucion_id");
    }

    // Relación: Una contribución pertenece a una obra
    public function obra(): BelongsTo
    {
        return $this->belongsTo(obra::class, "obra_id");
    }
}
