<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class instrumento extends Model
{
    protected $table = "instrumentos";

    public function Autores(): BelongsToMany
    {
        return $this->belongsToMany(autor::class);
    }

    public function partituras(): HasMany
    {
        return $this->hasMany(partitura::class, "instrumento_id");
    }

    public function Usuarios(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "usuario_instrumento", "instrumento_id_fk", "usuario_id_fk");
    }
}
