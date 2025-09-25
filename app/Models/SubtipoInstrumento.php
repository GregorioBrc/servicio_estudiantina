<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubtipoInstrumento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'instrumento_id'
    ];

    public function instrumento()
    {
        return $this->belongsTo(Instrumento::class);
    }
}
