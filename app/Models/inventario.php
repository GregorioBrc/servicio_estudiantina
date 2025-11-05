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
    protected $table = "inventarios";

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
    // RECOMENDACIÓN 4: El array $fillable estaba incompleto y tenía un error de mayúsculas.
    // Se han añadido todos los campos de la tabla que deben poder llenarse desde el controlador.
    protected $fillable = [
        "partitura_id",
        "estante_id",
        "instrumento", // Campo añadido en una migración posterior
        "cantidad",    // Corregido de "Cantidad" a "cantidad"
        "cantidad_disponible",
        "estado",
        "notas"
    ];

    /**
     * Define la relación inversa de uno a muchos con el modelo Estante.
     * Un ítem de inventario PERTENECE A un Estante.
     */
    // RECOMENDACIÓN 5: Corregido el nombre de la función y el método de la relación.
    public function estante(): BelongsTo
    {
        // El nombre del método es en camelCase: "belongsTo".
        // El nombre del modelo relacionado es en PascalCase: "Estante".
        return $this->belongsTo(Estante::class, "estante_id");
    }

    /**
     * Define la relación inversa de uno a muchos con el modelo Partitura.
     * Un ítem de inventario PERTENECE A una Partitura.
     */
    public function partitura(): BelongsTo
    {
        return $this->belongsTo(Partitura::class, "partitura_id");
    }

    /**
     * RECOMENDACIÓN 6: Añadir la relación con los préstamos.
     * Define la relación de uno a muchos con el modelo Prestamo.
     * Un ítem de inventario PUEDE TENER MUCHOS Préstamos.
     */
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class, 'inventario_id');
    }
}