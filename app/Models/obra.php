<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class obra extends Model
{
    use HasFactory;
    protected $table = "obras";
    public $timestamps = false;

    public $fillable = [
        "titulo",
        "anio"
    ];

    public function contribuciones()
    {
        return $this->hasMany(contribuciones::class);
    }

    // Acceso a los autores/contribuyentes de esta obra
    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(autor::class, 'contribuciones')
            ->using(contribuciones::class) // Opcional, si usas modelo personalizado
            ->withPivot('tipo_contribucion_id'); // Para acceder al tipo desde la relación
    }

    public function partituras(): HasMany
    {
        return $this->hasMany(partitura::class, "obra_id");
    }

    public function tiposDeContribucion(): belongsToMany
    {
        return $this->belongsToMany(tipo_contribucion::class, 'contribuciones');
    }

    public function getRouteKeyName()
    {
        return 'titulo';
    }
}
