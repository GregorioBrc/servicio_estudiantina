<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contribuciones extends Model
{
    protected $table = "contribuciones";

    // Relación: Una contribución pertenece a un autor
    public function autor()
    {
        return $this->belongsTo(autor::class, "autor_id");
    }

    // Relación: Una contribución pertenece a un tipo de contribución
    public function tipoContribucion()
    {
        return $this->belongsTo(tipo_contribucion::class, "tipo_contribucion_id");
    }

    // Relación: Una contribución pertenece a una obra
    public function obra()
    {
        return $this->belongsTo(obra::class, "obra_id");
    }
}
