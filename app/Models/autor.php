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
        return $this->hasManyThrough(Obra::class, contribuciones::class);
    }
}
