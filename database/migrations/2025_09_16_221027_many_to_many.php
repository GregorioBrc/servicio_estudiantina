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
        Schema::create("instrumento_autor", function (Blueprint $table) {
            $table->foreignId("instrumento_id_fk")->constrained("instrumentos","id")->cascadeOnDelete();
            $table->foreignId("autor_id_fk")->constrained("autores","id")->cascadeOnDelete();
            $table->primary(["instrumento_id_fk","autor_id_fk"]);
        });

        Schema::create("usuario_instrumento", function (Blueprint $table) {
            $table->foreignId("usuario_id_fk")->constrained("users","id")->cascadeOnDelete();
            $table->foreignId("instrumento_id_fk")->constrained("instrumentos","id")->cascadeOnDelete();
            $table->primary(["usuario_id_fk","instrumento_id_fk"]);
        });

        Schema::create("contribuciones", function (Blueprint $table) {
            $table->foreignId("autor_id")->constrained("autores","id")->cascadeOnDelete();
            $table->foreignId("tipo_contribucion_id")->constrained("tipo_contribuciones","id")->cascadeOnDelete();
            $table->foreignId("obra_id")->constrained("obras","id")->cascadeOnDelete();
            $table->primary(["autor_id","tipo_contribucion_id","obra_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("instrumento_autor");
        Schema::dropIfExists("usuario_instrumento");
        Schema::dropIfExists("contribuciones");
    }
};
