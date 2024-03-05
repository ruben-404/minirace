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
        Schema::create('inscritos', function (Blueprint $table) {
            // Clave primaria compuesta
            $table->string('DNIcorredor');
            $table->unsignedBigInteger('idCarrera');
            $table->primary(['DNIcorredor', 'idCarrera']);

            // Claves foráneas
            $table->foreign('DNIcorredor')->references('DNI')->on('corredors');
            $table->foreign('idCarrera')->references('idCarrera')->on('carreres');

            // Clave foránea opcional
            $table->string('CIFasseguradora')->nullable();
            $table->foreign('CIFasseguradora')->references('CIF')->on('asseguradores');

            // Otros campos
            $table->integer('numDorsal');
            $table->date('dataArribada')->nullable();
            $table->integer('temps')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscritos');
    }
};
