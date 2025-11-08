<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class prestamo extends Model
{
    use HasFactory;
    protected $table = "prestamos";
    public $timestamps = false;

    public $fillable = [
        "descripcion",
        "cantidad",
        "usuario_inventario_id",
        "partitura_id",
        "estante_id"
    ];

    public function Usuario_Inventario(): BelongsTo
    {
        return $this->BelongsTo(usuario_inventario::class, "usuario_inventario_id");
    }

    public function Partitura(): BelongsTo
    {
            return $this->belongsTo(partitura::class, "partitura_id");
    }

    public function Estante(): BelongsTo
    {
        return $this->BelongsTo(estante::class, "estante_id");
    }

     public function inventario()
    {
        return $this->belongsTo(inventario::class);
    }

    public function returnKeyName()
    {
        return 'id';
    }
}
