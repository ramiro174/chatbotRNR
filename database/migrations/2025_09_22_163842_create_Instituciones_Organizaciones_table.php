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
        Schema::create('Instituciones_Organizaciones', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('Institucion_Organizacion', 345)->nullable();
            $table->string('Estado', 345)->nullable();
            $table->string('Municipio', 345)->nullable();
            $table->string('Dias_de_atencion', 345)->nullable();
            $table->string('Horario', 345)->nullable();
            $table->string('Clasificacion', 345)->nullable();
            $table->string('Otra', 345)->nullable();
            $table->string('Psicologica', 345)->nullable();
            $table->string('Legal', 345)->nullable();
            $table->string('Medica', 345)->nullable();
            $table->string('Social', 345)->nullable();
            $table->string('Refiere_a_Refugio', 345)->nullable();
            $table->string('Digital', 345)->nullable();
            $table->string('Caracteristica', 645)->nullable();
            $table->string('Telefono', 345)->nullable();
            $table->string('Email', 345)->nullable();
            $table->string('Pagina_web', 345)->nullable();
            $table->string('Whats_APP', 345)->nullable();
            $table->string('Facebook', 345)->nullable();
            $table->string('Instagram', 345)->nullable();
            $table->string('Twitter', 345)->nullable();
            $table->tinyInteger('Mujer')->nullable();
            $table->integer('Edad_Mini_Mu')->nullable();
            $table->integer('Edad_M_Mu')->nullable();
            $table->tinyInteger('Hombre')->nullable();
            $table->integer('Edad_Mini_Ho')->nullable();
            $table->integer('Edad_M_Ho')->nullable();
            $table->string('Otras_identidades', 345)->nullable();
            $table->integer('Edad_Mini')->nullable();
            $table->integer('Edad_M')->nullable();
            $table->string('Mensaje', 545)->nullable();
            $table->tinyInteger('Estatus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Instituciones_Organizaciones');
    }
};
