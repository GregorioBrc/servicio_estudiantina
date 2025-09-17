<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class inventario extends Model
{
    protected $table = "inventario";

    public function Estante(): BelongsTo
    {
        return $this->BelongsTo(estante::class,"estante_id",);
    }

    public function partitura(): BelongsTo
    {
        return $this->BelongsTo(partitura::class, "partitura_id");
    }
}
