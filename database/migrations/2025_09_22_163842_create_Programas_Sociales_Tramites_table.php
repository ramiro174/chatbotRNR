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
        Schema::create('Programas_Sociales_Tramites', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('Tipo', 45)->nullable();
            $table->string('Caracteristicas', 45)->nullable();
            $table->string('Dirigida_A', 45)->nullable();
            $table->string('Nombre', 845)->nullable();
            $table->string('Link', 45)->nullable();
            $table->string('Vigencia', 45)->nullable();
            $table->tinyInteger('Estatus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Programas_Sociales_Tramites');
    }
};
