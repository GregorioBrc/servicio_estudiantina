<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class inventario extends Model
{
    protected $table = "inventario";

    public function Estante(): HasMany
    {
        return $this->hasMany(estante::class, "estante_id");
    }

    public function partitura(): HasMany
    {
        return $this->hasMany(partitura::class, "partitura_id");
    }
}
