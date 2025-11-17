<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class usuario_inventario extends Model
{
    use HasFactory;

    protected $table = "usuarios_inventario";
    public $timestamps = false;

    public $fillable = [
        "nombre",
        "correo",
        "password"
    ];

    public function Prestamos(): HasMany
    {
        return $this->hasMany(prestamo::class, "usuario_inventario_id");
    }

    public function returnKeyName()
    {
        return 'nombre';
    }
}
