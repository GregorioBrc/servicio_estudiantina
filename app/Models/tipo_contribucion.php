<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_contribucion extends Model
{
    use HasFactory;
    protected $table = "tipo_contribuciones";
    public $timestamps = false;

    public $fillable = [
        "nombre_contribucion"
    ];

    public function contribuciones()
    {
        return $this->hasMany(contribuciones::class, "tipo_contribucion_id");
    }

    public function getRouteKeyName()
    {
        return 'nombre_contribucion';
    }
}
