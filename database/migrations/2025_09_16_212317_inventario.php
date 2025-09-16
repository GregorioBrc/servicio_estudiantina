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
        Schema::create("usuario_inventario", function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("correo");
            $table->string("password");
        });

        Schema::create("estantes", function (Blueprint $table) {
            $table->id();
            $table->smallInteger("gaveta");
        });

        Schema::create("inventario", function (Blueprint $table) {
            $table->foreignId("partitura_id")->constrained("partituras","id");
            $table->foreignId("estante_id")->constrained("estantes","id");
        });

        Schema::create("prestamos", function (Blueprint $table) {
            $table->id();
            $table->string("descripcion");
            $table->foreignId("usuario_inventario_id")->constrained("usuario_inventario","id");
            $table->foreignId("partitura_id")->constrained("partituras","id");
            $table->foreignId("estante_id")->constrained("estantes","id");
            $table->index(["usuario_inventario_id"]);
            $table->index(["partitura_id"]);
            $table->index(["estante_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("usuario_inventario");
        Schema::dropIfExists("estantes");
        Schema::dropIfExists("inventario");
        Schema::dropIfExists("prestamos");
    }
};
