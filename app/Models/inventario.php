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

    /**
     * El nombre de la tabla asociada con el modelo.
     * La convención de Laravel buscaría "inventarios" (plural), que coincide con tus migraciones.
     * @var string
     */
    // RECOMENDACIÓN 2: El nombre de la tabla en tus migraciones es "inventarios" (plural).
    protected $table = "inventario";

    /**
     * RECOMENDACIÓN 3: Tus migraciones SÍ incluyen timestamps ($table->timestamps()).
     * Por lo tanto, la línea "public $timestamps = false;" es incorrecta y debe eliminarse
     * para que Laravel gestione automáticamente las fechas de creación y actualización.
     */
    // public $timestamps = false; // <-- ESTA LÍNEA SE ELIMINA

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
  

    protected $fillable = [
        'partitura_id',
        'estante_id',
        'Cantidad', // OJO: La 'C' es mayúscula, igual que en tu migración.
    ];

    /**
     * Define la relación inversa: una entrada de inventario pertenece a UNA Partitura.
     */
    public function partitura(): BelongsTo
    {
        return $this->belongsTo(partitura::class, 'partitura_id');
    }

    /**
     * Define la relación inversa: una entrada de inventario pertenece a UN Estante.
     */
    public function estante(): BelongsTo
    {
        return $this->belongsTo(estante::class, 'estante_id');
    }
 
}