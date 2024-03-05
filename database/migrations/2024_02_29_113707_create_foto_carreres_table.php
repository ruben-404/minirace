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
        Schema::create('foto_carreres', function (Blueprint $table) {
            // Clave primaria
            $table->increments('idFoto');

            // Clave foránea
            $table->unsignedBigInteger('idCarrera');
            $table->foreign('idCarrera')->references('idCarrera')->on('carreres')->onDelete('cascade');

            // Otros campos
            $table->string('ruta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_carreres');
    }
};
