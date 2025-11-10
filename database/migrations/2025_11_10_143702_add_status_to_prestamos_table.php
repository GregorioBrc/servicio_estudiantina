<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('prestamos', function (Blueprint $table) {
            // 'activo' o 'inactivo'
            $table->string('estado')->default('activo')->after('estante_id'); 
            // La fecha de devolución puede ser nula si el préstamo está activo
            $table->timestamp('fecha_devolucion')->nullable()->after('estado'); 
        });
    }

    public function down(): void
    {
        Schema::table('prestamos', function (Blueprint $table) {
            $table->dropColumn(['estado', 'fecha_devolucion']);
        });
    }
};
