<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipo_contribucion extends Model
{
    protected $table = "tipo_contribuciones";
    public $timestamps = false;

    public function contribuciones()
    {
        return $this->hasMany(contribuciones::class, "tipo_contribucion_id");
    }
}
