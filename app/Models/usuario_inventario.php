<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class usuario_inventario extends Model
{
    protected $table = "usuarios_inventario";
    public $timestamps = false;

    public function Prestamos(): HasMany
    {
        return $this->hasMany(prestamo::class, "usuario_inventario_id");
    }
}
