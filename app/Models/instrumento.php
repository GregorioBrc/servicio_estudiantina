<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class instrumento extends Model
{
    use HasFactory;
    protected $table = "instrumentos";
    public $timestamps = false;

    public $fillable = [
        "nombre",
        "tipo"
    ];

    public function Autores(): BelongsToMany
    {
        return $this->belongsToMany(autor::class, "instrumento_autor", "instrumento_id_fk", "autor_id_fk");
    }

    public function partituras(): HasMany
    {
        return $this->hasMany(partitura::class, "instrumento_id");
    }

    public function Usuarios(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "usuario_instrumento", "instrumento_id_fk", "usuario_id_fk");
    }

    public function getRouteKeyName()
    {
        return 'nombre';
    }
}
