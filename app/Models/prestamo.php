<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class prestamo extends Model
{
    protected $table = "prestamos";

    public function Usuario_Inventario(): HasOne
    {
        return $this->hasOne(usuario_inventario::class, "usuario_inventario_id");
    }

    public function Partitura(): HasOne
    {
        return $this->hasOne(usuario_inventario::class, "partitura_id");
    }

    public function Estante(): HasOne
    {
        return $this->hasOne(estante::class, "estante_id");
    }
}
