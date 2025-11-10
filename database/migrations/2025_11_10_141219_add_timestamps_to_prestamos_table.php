<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
      public function up(): void
    {
        Schema::table('prestamos', function (Blueprint $table) {
            // Esto añade las columnas 'created_at' y 'updated_at'
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::table('prestamos', function (Blueprint $table) {
            // Esto permite revertir la migración si es necesario
            $table->dropTimestamps();
        });
    }
};
