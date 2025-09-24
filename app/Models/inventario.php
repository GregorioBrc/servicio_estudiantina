<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class inventario extends Model
{
    use HasFactory;
    protected $table = "inventario";
    public $timestamps = false;

    public $fillable = [
        "partitura_id",
        "estante_id",
        "Cantidad",
    ];

    public function Estante(): BelongsTo
    {
        return $this->BelongsTo(estante::class,"estante_id",);
    }

    public function partitura(): BelongsTo
    {
        return $this->BelongsTo(partitura::class, "partitura_id");
    }
}
