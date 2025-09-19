<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class partitura extends Model
{
    use HasFactory;
    public $table = "partituras";
    public $timestamps = false;

    public function instrumento(): BelongsTo
    {
        return $this->BelongsTo(instrumento::class, "instrumento_id");
    }

    public function obra(): BelongsTo
    {
        return $this->BelongsTo(obra::class, "obra_id");
    }

    public function Prestamos(): HasMany
    {
        return $this->hasMany(prestamo::class,"partitura_id");
    }

    public function inventario_estante(): BelongsToMany
    {
        return $this->belongsToMany(estante::class,"inventario","partitura_id","estante_id");
    }
}
