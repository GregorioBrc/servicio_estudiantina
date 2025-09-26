<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class autor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "autores";

    public $fillable = [
        "nombre"
    ];

    public function instrumentos(): BelongsToMany
    {
        return $this->belongsToMany(instrumento::class, "instrumento_autor", "autor_id_fk", "instrumento_id_fk");
    }

    public function contribuciones(): HasMany
    {
        return $this->hasMany(contribuciones::class);
    }

    // Acceso directo a las obras de este autor (a través de contribuciones)
    public function obras(): HasManyThrough
    {
        return $this->hasManyThrough(
            obra::class,          // 1. Modelo final
            contribuciones::class,  // 2. Modelo intermedio
            'autor_id',           // 3. Clave foránea en la tabla 'contribuciones' que nos conecta con 'autores'
            'id',                 // 4. Clave foránea en la tabla 'obras' (es el 'id' de la obra)
            'id',                 // 5. Clave local en la tabla 'autores' (es el 'id' del autor)
            'obra_id'            // 6. Clave local en la tabla 'contribuciones' que nos conecta con 'obras'
        );
    }

    public function getRouteKeyName()
    {
        return 'nombre';
    }
}
