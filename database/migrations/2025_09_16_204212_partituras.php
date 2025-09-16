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
        Schema::create("obras", function (Blueprint $table) {
        $table->id();
        $table->string("titulo");
        $table->integer("anio");
        });

        Schema::create("partituras", function (Blueprint $table) {
            $table->id();
            $table->string("url_pdf");
            $table->string("link_video")->nullable();
            $table->foreignId("obra_id")->constrained("obras","id")->cascadeOnDelete();
            $table->foreignId("instrumento_id")->constrained("instrumentos","id")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("obras");
        Schema::dropIfExists("partituras");
    }
};
