<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('prestamos', function (Blueprint $table) {
            $table->string('obra_titulo')->nullable()->after('partitura_id');
            $table->timestamp('fecha_prestamo')->nullable()->after('cantidad');
            $table->timestamp('fecha_devolucion')->nullable()->after('fecha_prestamo');
            $table->string('estado', 20)->default('Pendiente')->after('fecha_devolucion');
        });
    }

    public function down(): void {
        Schema::table('prestamos', function (Blueprint $table) {
            $table->dropColumn(['obra_titulo','fecha_prestamo','fecha_devolucion','estado']);
        });
    }
};