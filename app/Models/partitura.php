<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class partitura extends Model
{
    public $table = "partituras";

    public function instrumento(): HasOne
    {
        return $this->HasOne(instrumento::class, "instrumento_id");
    }

    public function obra(): HasOne
    {
        return $this->HasOne(obra::class, "obra_id");
    }
}
