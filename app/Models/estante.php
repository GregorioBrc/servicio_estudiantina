<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class estante extends Model
{
    protected $table = "estantes";
    public $timestamps = false;

    public function Prestamos(): HasMany
    {
        return $this->hasMany(prestamo::class, "estante_id");
    }

    public function Partituras(): BelongsToMany
    {
        return $this->belongsToMany(Partitura::class, "inventario", "estante_id", "partitura_id")
            ->withPivot('Cantidad');
    }
}
